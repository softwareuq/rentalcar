<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renta;
use App\User;
use App\Vehiculo;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class RentasController extends Controller
{

  public function __construct(){
    date_default_timezone_set('America/Bogota');
    Carbon::setLocale('es');
  }

  public function index(Request $request){

    $rentas = Renta::orderBy('id','DESC')->paginate(20);

    if (sizeof($rentas)>0) {
      if ($request->search=="") {
        $rentas = Renta::orderBy('id','DESC')->paginate(20);
        $rentas->each(function($renta){
          $renta->usuario;
          $renta->vehiculo;
        });
      }else{

        if($request->tipo=='Cedula'){
          $user = User::searchCedula($request->search)->get()->toArray();
          if (sizeof($user) > 0) {
            $usuario = $user[0];
            $rentas = Renta::searchUser($usuario['id'])->orderBy('id','DESC')->paginate(20);
          }else{
            Flash::warning('No se han encontrado resultados para su busqueda');
            return redirect()->route('management.rentas.index');
          }

        }elseif ($request->tipo=="Placa") {
          $vehiculo = Vehiculo::searchPlaca($request->search)->get()->toArray();
          if (sizeof($vehiculo) > 0) {
            $car = $vehiculo[0];
            $rentas = Renta::searchVehiculo($car['id'])->orderBy('id','DESC')->paginate(20);
          }else{
            Flash::warning('No se han encontrado resultados para su busqueda');
            return redirect()->route('management.rentas.index');
          }

        }elseif ($request->tipo=="CodRenta") {
          $rentas = Renta::searchCod($request->search)->orderBy('id','DESC')->paginate(20);

        }elseif ($request->tipo=="Estado") {
          $rentas = Renta::searchEstado($request->search)->orderBy('id','ASC')->paginate(20);
        }
      }

      if (sizeof($rentas)==0) {
        Flash::warning('No se han encontrado resultados para su busqueda');
        return redirect()->route('management.rentas.index');
      }
    }
    return view('management/rentas/index',['rentas'=>$rentas]);
  }

  public function store(Request $request,$id){
    $vehiculo = Vehiculo::find($id);

    if($vehiculo->disponible==true){
      $renta = new Renta();
      $renta->fecha = Carbon::now();
      $renta->kilometrajeActual = $vehiculo->kilometraje;
      $renta->estado = "pedido";
      $renta->usuario_id = \Auth::user()->id;;
      $renta->vehiculo_id = $vehiculo->id;
      $renta->save();

      $vehiculo->disponible=false;
      $vehiculo->save();

      Flash::success('Vehiculo rentado, usted dispone de dos horas para reclamar el vehiculo');
      return redirect()->route('management.rentas.index');
    }else{
      Flash::warning('El vehiculo ya no se encuentra disponible');
      return redirect()->route('management.vehiculos.index');
    }
  }

  public function destroy($id){
    $renta = Renta::find($id);
    $vehiculo = Vehiculo::find($renta->vehiculo->id);

    if($renta->estado=="pedido"){
      $vehiculo->disponible==true;
      $vehiculo->save();
      $renta->delete();
    }elseif($renta->estado=="entregado" && $renta->devolucion==null){
      Flash::warning('La renta no puede ser eliminada, el vehiculo no ha sido devuelto');
      return redirect()->route('management.rentas.index');
    }elseif($renta->estado=="entregado" && $renta->devolucion!=null){
      $renta->delete();
    }elseif($renta->estado == "cancelado"){
      $renta->delete();
    }

    Flash::warning('La renta ha sido eliminada');
    return redirect()->route('management.rentas.index');
  }

  public function entrega($id){
    $renta = Renta::find($id);
    $renta->estado = "entregado";
    $renta->fecha = Carbon::now();
    $renta->save();

    Flash::info('El vehiculo ha sido entregado al cliente');
    return redirect()->route('management.rentas.index');
  }

  public function liberar($id){
    $renta = Renta::find($id);

    $vehiculo = Vehiculo::find($renta->vehiculo->id);
    $vehiculo->disponible=true;
    $vehiculo->save();

    $renta->estado="cancelado";
    $renta->save();

    Flash::success('El vehiculo ha sido liberado');
    return redirect()->route('management.rentas.index');
  }

  public function edit($id){
    $renta = Renta::find($id);
    $vehiculos = Vehiculo::searchDisponibilidad(1)->orderBy('id','ASC')->paginate(20);
    return view('management/rentas/edit',['renta'=>$renta,'vehiculos'=>$vehiculos]);
  }

  public function update(Request $request,$id){
    $renta = Renta::find($id);
    $vehiculo = Vehiculo::find($renta->vehiculo->id);
    $newVehicle = Vehiculo::find($request->vehiculo);

    if($renta->estado == "entregado"){
      Flash::success('El vehiculo ya ha sido entregado, no se puede realizar la modificación');
      return redirect()->route('management.rentas.index');
    }

    if ($newVehicle->disponible==true) {
      $vehiculo->disponible=true;
      $vehiculo->save();

      $newVehicle->disponible=false;
      $newVehicle->save();

      $renta->vehiculo_id=$newVehicle->id;
      $renta->fecha = $renta->created_at;
      $renta->save();

      Flash::success('La renta ha sido modificada');
      return redirect()->route('management.rentas.index');
    }else{
      Flash::info('El vehiculo ya no se encuentra disponible');
      return redirect()->route('management.rentas.index');
    }
  }

  public function reporte(){
    return view('management/rentas/reporte');
  }

  public function getRentas(){
    $rentas = Renta::orderBy('fecha','DESC')->get();
    $rentas->each(function($renta){
      $renta->usuario;
      $renta->vehiculo;
    });
    return response()->json($rentas->toArray());
  }

}
