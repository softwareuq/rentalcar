<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renta;
use App\User;
use App\Vehiculo;
use App\Devolucion;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Http\Requests;
use Dompdf\Dompdf;

class DevolucionesController extends Controller
{

  public function __construct(){
    date_default_timezone_set('America/Bogota');
    Carbon::setLocale('es');
  }

  public function index(){
    $devoluciones = Devolucion::orderBy('id','DESC')->paginate(20);
    $devoluciones->each(function($devolucion){
      $devolucion->renta;
    });
    return view('management/devoluciones/index',['devoluciones'=>$devoluciones]);
  }

  public function create($id){
    $renta = Renta::find($id);
    return view('management/devoluciones/create',['renta'=>$renta]);
  }

  public function store(Request $request,$idRenta){
    $devo = new Devolucion();
    $renta = Renta::find($idRenta);
    $vehiculo = Vehiculo::find($renta->vehiculo->id);
    $cliente = User::find($renta->usuario->id);

    $devo->fecha= Carbon::now();
    $devo->kilometrajeActual = $request->kilometraje;
    $devo->estadoVehiculo = $request->estadoVehiculo;
    $devo->observaciones = $request->observaciones;

    $fecha = Carbon::parse($renta->fecha);
    $now = Carbon::now();
    $tiempo = $fecha->diffInHours($now,false);

    $devo->horasDeUso = $tiempo + 1;
    $devo->valorPagado = $vehiculo->precioAlquiler*$devo->horasDeUso;
    $devo->bono = 0;
    $devo->renta_id = $renta->id;
    $devo->save();

    //actualizar estado de vehiculo
    $vehiculo->disponible = true;
    $vehiculo->kilometraje= $devo->kilometrajeActual;
    $vehiculo->save();

    //sumar horas al cliente
    $cliente->horasAcumuladas = $cliente->horasAcumuladas + $devo->horasDeUso;
    $cliente->save();

    //Asignacion de bono DEBO DEVOLVER EL BONO PARA MOSTRARLO EN LA FACTURA
    $bono = 0;
    if($cliente->horasAcumuladas>=100){
      $cliente->horasAcumuladas=0;
      $cliente->save();

      if($devo->valorPagado>=50000){
        $bono = 50000;
        $devo->bono = $bono;
        $devo->valorPagado = $devo->valorPagado-50000;
      }else{
        $bono = $devo->valorPagado;
        $devo->bono = $bono;
        $devo->valorPagado = 0;
      }
      $devo->save();
    }

    //GENERAR LA FACTURA PARA IMPRIMIR
    return redirect()->route('management.devoluciones.facturar',$devo);
  }

  public function facturar($devo){
    $devolucion = Devolucion::find($devo);
    return view('management/devoluciones/factura',['devolucion'=>$devolucion]);
  }

  public function imprimirFactura($devo){
    $devolucion = Devolucion::find($devo);
    $renta = Renta::find($devolucion->renta->id);
    $cliente = User::find($devolucion->renta->usuario->id);
    $vehiculo = Vehiculo::find($devolucion->renta->vehiculo->id);

    $total = $devolucion->valorPagado- $devolucion->bono;

    $htmlCode = "<div style='width:50%; margin-left:25%;border:solid;background-color:white;'>
                  <div align='center'>
                    <div class='imagen' style='width:100%;'>
                      <img style='width:30%;' src='images/logofactura/holalogo.jpg'/>
                    </div>
                    <h2 style='margin-top:0px;margin-bottom:0px;'>RentalCar S.A.S</h2>
                    NIT: 0614-290209-000-1
                  </div>
                  <div class='body' style='padding:4px;'>
                    <div class='info-factura'>
                      Codigo de factura:".$devolucion->id."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                           &nbsp;
                      Fecha: ".$devolucion->created_at."
                    </div>
                    <div class='info-cliente' style='margin-top:5px;border-top:solid 1px grey;''>
                      <div align='center'>
                        <h4 style='margin:0px;'>Cliente</h4>
                      </div>
                      Nombre:&nbsp;&nbsp;&nbsp; ".$devolucion->renta->usuario->name."
                      <br>
                      Telefono:&nbsp;&nbsp; ".$devolucion->renta->usuario->telefono."
                      <br>
                      Licencia:&nbsp;&nbsp;&nbsp; ".$devolucion->renta->usuario->licencia."
                    </div>
                    <div class='info-renta' style='margin-top:5px;border-top:solid 1px grey;'>
                      <div align='center'>
                        <h4 style='margin:0px;'>Renta</h4>
                      </div>
                      Codigo de renta:&nbsp;&nbsp;&nbsp; ".$devolucion->renta->id."
                      <br>
                      Fecha:&nbsp;&nbsp; ".$devolucion->renta->created_at."
                    </div>
                    <div class='info-vehiculo' style='margin-top:5px;border-top:solid 1px grey;'>
                      <div align='center'>
                        <h4 style='margin:0px;'>Vehiculo</h4>
                      </div>
                      <div class='row'>
                        <div class='col-md-6'>
                          Placa: ".$devolucion->renta->vehiculo->placa."
                        </div>
                        <div class='col-md-6'>
                          Marca: ".$devolucion->renta->vehiculo->marca->nombre."
                        </div>
                        <div class='col-md-6'>
                          Tipo: ".$devolucion->renta->vehiculo->tipo->nombre."
                        </div>
                        <div class='col-md-6'>
                          Modelo: ".$devolucion->renta->vehiculo->modelo."
                        </div>
                        <div class='col-md-12'>
                          Precio por hora: $".$devolucion->renta->vehiculo->precioAlquiler."
                        </div>
                      </div>
                    </div>
                    <div class='info-devolucion' style='margin-top:5px;border-top:solid 1px grey;'>
                      <div align='center'>
                        <h4 style='margin:0px;'>Devolución</h4>
                      </div>
                      Fecha: ".$devolucion->created_at."
                      <br>
                      <div style='background-color:#CCD7DB'>
                        Subtotal: ".$devolucion->valorPagado."
                        <br>
                        Bono: $".$devolucion->bono."
                        <br>
                        Total: $".$total."
                      </div>
                    </div>
                  </div>
                  <div class='footer' align='center' style='margin-top:5px;border-top:solid 1px grey;'>
                    <span>***************</span>
                    <br>
                    Ingresa a www.rentalcar.com para mas informacion y servicios
                    <br>
                    Sistema de renta vehicular v 1.0
                    <br>
                    <span>***************</span>
                  </div>
                </div>";


    $dompdf = new Dompdf();
    $dompdf->loadHtml($htmlCode);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream('factura-Cod'.$devolucion->id);

    return redirect()->route('management.devoluciones.facturar',$devo);
  }
}
