@extends('management/template/main')

@section('title')
  Lista de rentas
@endsection

@section('content')

  <h2>Lista de rentas</h2>

  @if(Auth::user()->admin())
  <div class="row">
    <div class="search col-md-6">
      {!! Form::open(['route'=>'management.rentas.index','method'=>'GET','class'=>'navbar-form']) !!}
        <div class="form-group">
            <div>
              <input type="text" class="form-control" placeholder="Search for..." name="search">
              {!! Form::select('tipo',array('Cedula' => 'Cedula', 'CodRenta' => 'Codigo Renta','Placa' => 'Placa','Estado'=>'Estado'),'Cedula',['class'=>'form-control','required']) !!}
              <button class="btn btn-default" type="submit">Go!</button>
            </div>
        </div>
      {!! Form::close() !!}
    </div>
    <div class="reporte-rentas col-md-6" align="right">
      <a href="{{ route('management.rentas.reporte') }}" class="btn btn-success">Reporte de rentas</a>
    </div>
  </div>
  @endif

  @foreach($rentas as $renta)

    @if(Auth::user()->cliente() and $renta->usuario->id == Auth::user()->id)
    <div class="panel-group" id="accordion{{$renta->id}}" role="tablist" aria-multiselectable="true">
      <div class="panel panel-success">
        <div class="panel-heading" role="tab" id="headingOne{{$renta->id}}">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$renta->id}}" aria-expanded="true" aria-controls="collapseOne{{$renta->id}}">
              {{$renta->id}} | {{$renta->usuario->name}}
            </a>
          </h4>
        </div>
        <div id="collapseOne{{$renta->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne{{$renta->id}}">
          <div class="panel-body">

            <div class="row">
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de renta</h4>
                </div>
                Codigo: {{$renta->id}}
                <br>
                Fecha: {{$renta->fecha}}
                <br><br><br>
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Mi Información</h4>
                </div>
                Nombre: {{$renta->usuario->name}}
                <br>
                Identificación: {{$renta->usuario->cedula}}
                <br>
                Correo: {{$renta->usuario->email}}
                <br>
                Telefono: {{$renta->usuario->telefono}}
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información del vehiculo</h4>
                </div>
                Placa: {{$renta->vehiculo->placa}} &nbsp;&nbsp;|&nbsp;&nbsp; Kilometraje: {{$renta->kilometrajeActual}}
                <div class="panel">
                  <img style="height:200px;margin:auto;" class="img img-responsive" src="{{asset('images/vehiculos/'.$renta->vehiculo->nombreFoto)}}" alt="" />
                </div>
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de devolución</h4>
                </div>
                @if($renta->estado=='pedido')
                  <div class="" align="center">
                    <br><br>
                    <a href="{{route('management.rentas.liberar',$renta)}}" class="btn btn-success">Cancelar renta</a>
                    <br><br>
                    Usted solicito la renta {{$renta->created_at->diffForHumans()}}
                  </div>
                @elseif($renta->estado=='cancelado')
                <div class="" align="center">
                  <br><br>
                  <a class="btn btn-danger">La renta ha sido cancelada</a>
                </div>
                @elseif($renta->estado=='entregado' and $renta->devolucion == null)
                  <div class="" align="center">
                    <br><br><br>
                    Usted posee el vehiculo desde {{$renta->updated_at->diffForHumans()}}
                  </div>
                @elseif($renta->devolucion != null and $renta->estado=='entregado')
                  Codigo: {{$renta->devolucion->id}}
                  <br>
                  Fecha: {{$renta->devolucion->fecha}}
                  <br>
                  Kilometraje: {{$renta->devolucion->kilometrajeActual}} Km
                  <br>
                  Recorrido: {{$renta->devolucion->kilometrajeActual - $renta->kilometrajeActual}} Km
                  <br>
                  Tiempo de uso: {{$renta->devolucion->horasDeUso}} h
                  <br>
                  Valor pagado: {{$renta->devolucion->valorPagado}}
                @endif
              </div>
              <div class="col-md-12">
                <div class="" align="center">
                  @if($renta->estado=='pedido')
                    <a href=" {{ route('management.rentas.edit',$renta->id) }} " class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  @else
                    <a href=" {{ route('management.rentas.edit',$renta->id) }} " class="disabled btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  @endif
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    @endif

    @if(Auth::user()->admin())
    <div class="panel-group" id="accordion{{$renta->id}}" role="tablist" aria-multiselectable="true">
      <div class="panel panel-success">
        <div class="panel-heading" role="tab" id="headingOne{{$renta->id}}">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$renta->id}}" aria-expanded="true" aria-controls="collapseOne{{$renta->id}}">
              {{$renta->id}} | {{$renta->usuario->name}}
            </a>
          </h4>
        </div>
        <div id="collapseOne{{$renta->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne{{$renta->id}}">
          <div class="panel-body">

            <div class="row">
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de renta</h4>
                </div>
                Codigo: {{$renta->id}}
                <br>
                Fecha: {{$renta->fecha}}
                <br><br><br>
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de usuario</h4>
                </div>
                Nombre: {{$renta->usuario->name}}
                <br>
                Identificación: {{$renta->usuario->cedula}}
                <br>
                Correo: {{$renta->usuario->email}}
                <br>
                Telefono: {{$renta->usuario->telefono}}
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información del vehiculo</h4>
                </div>
                Placa: {{$renta->vehiculo->placa}} &nbsp;&nbsp;|&nbsp;&nbsp; Kilometraje: {{$renta->kilometrajeActual}}
                <div class="panel">
                  <img style="height:200px;margin:auto;" class="img img-responsive" src="{{asset('images/vehiculos/'.$renta->vehiculo->nombreFoto)}}" alt="" />
                </div>
              </div>
              <div class="col-md-6" style="border-style: groove;border-width: 0px 1px 0px 0px;">
                <div class="" align="center">
                  <h4>Información de devolución</h4>
                </div>
                @if($renta->estado=='pedido')
                  <div class="" align="center">
                    <br><br>
                    <a href="{{route('management.rentas.entrega',$renta)}}" class="btn btn-success">Generar entrega</a>
                    <a href="{{route('management.rentas.liberar',$renta)}}" class="btn btn-success">Liberar vehiculo</a>
                    <br><br>
                    La renta se solicito {{$renta->created_at->diffForHumans()}}
                  </div>
                @elseif($renta->estado=='cancelado')
                <div class="" align="center">
                  <br><br>
                  <a class="btn btn-danger">La renta ha sido cancelada</a>
                </div>
                @elseif($renta->estado=='entregado' and $renta->devolucion == null)
                  <div class="" align="center">
                    <br><br>
                    <a href="{{route('management.devoluciones.create',$renta)}}" class="btn btn-danger">Registrar devolucion</a>
                    <br><br>
                    El vehiculo se entrego al cliente {{$renta->updated_at->diffForHumans()}}
                  </div>
                @elseif($renta->devolucion != null and $renta->estado=='entregado')
                  Codigo: {{$renta->devolucion->id}}
                  <br>
                  Fecha: {{$renta->devolucion->fecha}}
                  <br>
                  Kilometraje: {{$renta->devolucion->kilometrajeActual}} Km
                  <br>
                  Recorrido: {{$renta->devolucion->kilometrajeActual - $renta->kilometrajeActual}} Km
                  <br>
                  Tiempo de uso: {{$renta->devolucion->horasDeUso}} h
                  <br>
                  Valor pagado: {{$renta->devolucion->valorPagado}}
                @endif
              </div>
              <div class="col-md-12">
                <div class="" align="center">
                  <a href=" {{ route('management.rentas.destroy',$renta->id) }} " class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  @if($renta->estado=='pedido')
                    <a href=" {{ route('management.rentas.edit',$renta->id) }} " class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  @else
                    <a href=" {{ route('management.rentas.edit',$renta->id) }} " class="disabled btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  @endif
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    @endif

  @endforeach

  @if(Auth::user()->admin())
    {!! $rentas->render() !!}
  @endif
@endsection
