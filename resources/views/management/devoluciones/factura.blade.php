@extends('management/template/main')

@section('title')
  Factura
@endsection

@section('content')
  <div class="factura" style="width:50%; margin-left:25%;border:solid;background-color:white;">
    <div class="header" align="center">
      <div class="imagen" style="width:100%;">
        <img style="width:30%;" src="{{asset('images/logofactura/holalogo.jpg')}}" alt="" />
      </div>
      <h2 style="margin-top:0px;">RentalCar S.A.S</h2>
      <p>NIT: 0614-290209-000-1</p>
    </div>
    <div class="body" style="padding:4px;">
      <div class="row info-factura">
        <div class="col-md-6">
          Codigo de factura: {{$devolucion->id}}
        </div>
        <div class="col-md-6" align="right">
          Fecha: {{$devolucion->created_at}}
        </div>
      </div>
      <div class="info-cliente" style="margin-top:5px;border-top:solid 1px grey;">
        <div class="" align="center">
          <h4>Cliente</h4>
        </div>
        Nombre:&nbsp;&nbsp;&nbsp; {{$devolucion->renta->usuario->name}}
        <br>
        Telefono:&nbsp;&nbsp; {{$devolucion->renta->usuario->telefono}}
        <br>
        Licencia:&nbsp;&nbsp;&nbsp; {{$devolucion->renta->usuario->licencia}}
      </div>
      <div class="info-renta" style="margin-top:5px;border-top:solid 1px grey;">
        <div class="" align="center">
          <h4>Renta</h4>
        </div>
        Codigo de renta:&nbsp;&nbsp;&nbsp; {{$devolucion->renta->id}}
        <br>
        Fecha:&nbsp;&nbsp; {{$devolucion->renta->created_at}}
      </div>
      <div class="info-vehiculo" style="margin-top:5px;border-top:solid 1px grey;">
        <div class="" align="center">
          <h4>Vehiculo</h4>
        </div>
        <div class="row">
          <div class="col-md-6">
            Placa: {{$devolucion->renta->vehiculo->placa}}
          </div>
          <div class="col-md-6">
            Marca: {{$devolucion->renta->vehiculo->marca->nombre}}
          </div>
          <div class="col-md-6">
            Tipo: {{$devolucion->renta->vehiculo->tipo->nombre}}
          </div>
          <div class="col-md-6">
            Modelo: {{$devolucion->renta->vehiculo->modelo}}
          </div>
          <div class="col-md-12">
            Precio por hora: ${{$devolucion->renta->vehiculo->precioAlquiler}}
          </div>
        </div>
      </div>
      <div class="info-devolucion" style="margin-top:5px;border-top:solid 1px grey;">
        <div class="" align="center">
          <h4>Devolución</h4>
        </div>
        Fecha: {{$devolucion->created_at}}
        <br>
        <div class="" style="background-color:#CCD7DB">
          Subtotal: {{$devolucion->valorPagado}}
          <br>
          Bono: ${{$devolucion->bono}}
          <br>
          Total: ${{$devolucion->valorPagado- $devolucion->bono}}
        </div>
      </div>
    </div>
    <div class="footer" align="center" style="margin-top:5px;border-top:solid 1px grey;">
      <span>***************</span>
      <br>
      Ingresa a www.rentalcar.com para mas informacion y servicios
      <br>
      Sistema de renta vehicular v 1.0
      <br>
      <span>***************</span>
    </div>
  </div>

  <br>
  <div class="" align="center">
    <a href="{{route('management.devoluciones.imprimir',$devolucion)}}" class="btn btn-success">Imprimir</a>
    <a href="{{route('management.devoluciones.index')}}" class="btn btn-success">Finalizar</a>
  </div>
@endsection
