@extends('management/template/main')

@section('title')
  Lista de devoluciones
@endsection

@section('content')

  <div class="">
    <h2>Lista de devoluciones</h2>
  </div>

  @foreach($devoluciones as $devolucion)
    <div class="panel-group" id="accordion{{$devolucion->id}}" role="tablist" aria-multiselectable="true">
      <div class="panel panel-success">
        <div class="panel-heading" role="tab" id="headingOne{{$devolucion->id}}">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$devolucion->id}}" aria-expanded="true" aria-controls="collapseOne{{$devolucion->id}}">
              {{$devolucion->id}} | Cod Renta: {{$devolucion->renta->id}}
            </a>
          </h4>
        </div>
        <div id="collapseOne{{$devolucion->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne{{$devolucion->id}}">
          <div class="panel-body">

            <div class="row">
              <div class="col-md-12" style="border-style: groove;border-width: 1px 1px 1px 0px;">
                <div class="" align="center">
                  <h4>Información de devolución</h4>
                </div>
                Codigo: {{$devolucion->id}}
                <br>
                Fecha: {{$devolucion->fecha}}
                <br>
                Distancia recorrida: {{$devolucion->kilometrajeActual - $devolucion->renta->kilometrajeActual}} Km
                <br>
                Horas de uso: {{$devolucion->horasDeUso}} h
                <br>
                Valor Pagado: $ {{$devolucion->valorPagado}}
                <br>
                Estado Vehiculo: {{$devolucion->estadoVehiculo}}
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de renta</h4>
                </div>
                Codigo: {{$devolucion->renta->id}}
                <br>
                Fecha: {{$devolucion->renta->fecha}}
                <br><br><br>
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de usuario</h4>
                </div>
                Nombre: {{$devolucion->renta->usuario->name}}
                <br>
                Identificación: {{$devolucion->renta->usuario->cedula}}
                <br>
                Correo: {{$devolucion->renta->usuario->email}}
                <br>
                Telefono: {{$devolucion->renta->usuario->telefono}}
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  @endforeach

  {!! $devoluciones->render() !!}

@endsection
