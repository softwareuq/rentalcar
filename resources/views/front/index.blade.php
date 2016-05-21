@extends('front/template/main')

@section('content')
  <div class="vehiculos">
    @foreach($vehiculos as $vehiculo)
      <div class="panel panel-default col-md-4 col-sm-6 col-xs-12" style="">
        <div class="panel-heading" align="center" style="background-color:#DCDEDE;">
          {{$vehiculo->tipo->nombre}}
        </div>
        <div class="panel-body">
          <a href="{{route('management.vehiculos.getvehiculo',$vehiculo->id)}}"><img style="height:200px;margin:auto;padding:10px;" class="img img-responsive" src="{{asset('images/vehiculos/'.$vehiculo->nombreFoto)}}" alt=""/></a>
        </div>
        <div class="panel-footer" align="center">
          {{$vehiculo->marca->nombre}}
        </div>
      </div>
    @endforeach
  </div>

  <div class="col-md-12" align="center">
    {{$vehiculos->render()}}
  </div>
@endsection
