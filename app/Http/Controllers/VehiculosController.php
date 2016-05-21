<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Marca;
use App\Tipo;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Requests\VehiculoRequest;

class VehiculosController extends Controller
{

  public function index(Request $request){

    $marcas = Marca::orderBy('nombre','ASC')->lists('nombre','id');
    $tipos = Tipo::orderBy('nombre','ASC')->lists('nombre','id');
    $vehicles = Vehiculo::orderBy('id','ASC')->paginate(20);

    if (sizeof($vehicles)>0) {
      if ($request->search=="") {
        $vehicles = Vehiculo::orderBy('id','ASC')->paginate(20);
        $vehicles->each(function($vehiculo){
          $vehiculo->marca;
          $vehiculo->tipo;
        });
      }else{

        if($request->tipo=='Marca'){
          $mar = Marca::search($request->search)->get()->toArray();
          if (sizeof($mar) > 0) {
            $marca = $mar[0];
            $vehicles = Vehiculo::searchMarca($marca['id'])->orderBy('id','ASC')->paginate(20);
          }else{
            Flash::warning('No se han encontrado resultados para su busqueda');
            return redirect()->route('management.vehiculos.index');
          }

        }elseif ($request->tipo=="Tipo") {
          $tip = Tipo::search($request->search)->get()->toArray();
          if (sizeof($tip) > 0) {
            $tipo = $tip[0];
            $vehicles = Vehiculo::searchTipo($tipo['id'])->orderBy('id','ASC')->paginate(20);
          }else{
            Flash::warning('No se han encontrado resultados para su busqueda');
            return redirect()->route('management.vehiculos.index');
          }

        }elseif ($request->tipo=="Color") {
          $vehicles = Vehiculo::searchColor($request->search)->orderBy('id','ASC')->paginate(20);

        }elseif ($request->tipo=="Modelo") {
          $vehicles = Vehiculo::searchModelo($request->search)->orderBy('id','ASC')->paginate(20);

        }elseif ($request->tipo=="Placa") {
          $vehicles = Vehiculo::searchPlaca($request->search)->orderBy('id','ASC')->paginate(20);

        }elseif ($request->tipo=="Precio") {
          $vehicles = Vehiculo::searchPrecio($request->search)->orderBy('id','ASC')->paginate(20);

        }elseif ($request->tipo=="Capacidad") {
          $vehicles = Vehiculo::searchCapacidad($request->search)->orderBy('id','ASC')->paginate(20);

        }elseif ($request->tipo=="Disponibilidad") {
          $vehicles = Vehiculo::searchDisponibilidad($request->search)->orderBy('id','ASC')->paginate(20);
        }
      }

      if (sizeof($vehicles)==0) {
        Flash::warning('No se han encontrado resultados para su busqueda');
        return redirect()->route('management.vehiculos.index');
      }
    }
    return view('management/vehiculos/index',['vehiculos'=>$vehicles,'marcas'=>$marcas,'tipos'=>$tipos]);
  }

  public function store(VehiculoRequest $request){

    if($request->file('foto')){
      $file = $request->file('foto');
      $name = 'rentalcar_'.time().'.'.$file->getClientOriginalExtension();
      $path = public_path().'/images/vehiculos/';

      $fragmentos = explode(".", $name);
      $extension = end($fragmentos);
      $extensiones_validas = array("jpg", "png", "gif");
      if (in_array($extension, $extensiones_validas)) {
        $file->move($path,$name);

        $vehiculo = new Vehiculo();
        $vehiculo->placa = $request->placa;
        $vehiculo->nombreFoto = $name;
        $vehiculo->precioAlquiler = $request->precioAlquiler;
        $vehiculo->capacidad = $request->capacidad;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->disponible = true;
        $vehiculo->color = $request->color;
        $vehiculo->kilometraje = $request->kilometraje;
        $vehiculo->marca_id=$request->marca_id;
        $vehiculo->tipo_id=$request->tipo_id;

        $vehiculo->save();

        Flash::success('Vehiculo con placa '.$vehiculo->placa.' registrado');
        return redirect()->route('management.vehiculos.index');
      }else{
        Flash::warning('El archivo debe ser una imagen');
        return redirect()->route('management.vehiculos.index');
      }
    }
  }

  public function destroy($id){
    $vehiculo = Vehiculo::find($id);
    $vehiculo->delete();

    Flash::warning('El vehiculo de placa '.$vehiculo->placa.' ha sido eliminado');
    return redirect()->route('management.vehiculos.index');
  }

  public function edit($id){
    $marcas = Marca::orderBy('nombre','ASC')->lists('nombre','id');
    $tipos = Tipo::orderBy('nombre','ASC')->lists('nombre','id');
    $vehiculo = Vehiculo::find($id);
    return view('management/vehiculos/edit',['vehiculo'=>$vehiculo,'marcas'=>$marcas,'tipos'=>$tipos]);
  }

  public function update(Request $request,$id){
    $vehiculo = Vehiculo::find($id);

    $vehiculos = Vehiculo::all();
    $flagPlaca = false;

    foreach ($vehiculos as $car) {
      if($car->placa == $request->placa && $car->id != $id){
        $flagPlaca = true;
      }
    }

    if ($flagPlaca == true) {
      Flash::warning('Ya existe un vehiculo registrado con esta placa');
      return redirect()->route('management.vehiculos.edit',$id);
    }
    if ($flagPlaca == false) {
      if($request->file('foto')){
        $file = $request->file('foto');
        $name = 'rentalcar_'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/images/vehiculos/';

        $fragmentos = explode(".", $name);
        $extension = end($fragmentos);
        $extensiones_validas = array("jpg", "png", "gif");
        if (in_array($extension, $extensiones_validas)) {
          $file->move($path,$name);

          $vehiculo->placa = $request->placa;
          $vehiculo->nombreFoto = $name;
          $vehiculo->precioAlquiler = $request->precioAlquiler;
          $vehiculo->capacidad = $request->capacidad;
          $vehiculo->modelo = $request->modelo;
          $vehiculo->disponible = $request->disponible;
          $vehiculo->color = $request->color;
          $vehiculo->kilometraje = $request->kilometraje;
          $vehiculo->marca_id=$request->marca_id;
          $vehiculo->tipo_id=$request->tipo_id;

          $vehiculo->save();

          Flash::success('Vehiculo con placa '.$vehiculo->placa.' actualizado');
          return redirect()->route('management.vehiculos.index');
        }else{
          Flash::warning('El archivo debe ser una imagen');
          return redirect()->route('management.vehiculos.index');
        }
      }else{
        Flash::warning('Debe proveer una imagen');
        return redirect()->route('management.vehiculos.edit',$id);
      }
    }
  }

  public function reporte(){
    $vehiculos = Vehiculo::all();
    return view('management/vehiculos/reporte',['vehiculos'=>$vehiculos]);
  }

  public function kilometraje(){
    $vehiculos = Vehiculo::orderBy('kilometraje','DESC')->take(10)->get();
    return response()->json($vehiculos->toArray());
  }

  public function allvehicles(){
    $vehiculos = Vehiculo::all();
    $vehiculos->each(function($vehiculo){
      $vehiculo->tipo;
      $vehiculo->marca;
    });
    return response()->json($vehiculos);
  }

  public function topvehiculos(){
    $vehiculos = Vehiculo::topVehiculos();
    return response()->json($vehiculos);
  }

  public function getVehiculo($id){
    $vehicles = Vehiculo::searchId($id)->orderBy('id','ASC')->paginate(1);
    $marcas = Marca::orderBy('nombre','ASC')->lists('nombre','id');
    $tipos = Tipo::orderBy('nombre','ASC')->lists('nombre','id');

    return view('management/vehiculos/index',['vehiculos'=>$vehicles,'marcas'=>$marcas,'tipos'=>$tipos]);
  }
}
