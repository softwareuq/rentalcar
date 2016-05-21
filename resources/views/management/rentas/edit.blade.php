@extends('management/template/main')

@section('title')
  Editar datos de renta {{$renta->id}}
@endsection

@section('content')

  {!! Form::open(['route'=>['management.rentas.update',$renta],'method'=>'PUT','class'=>'form-horizontal']) !!}
    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="cedula">Fecha:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" disabled type="text" name="cedula" value="{{$renta->fecha}}" required>
      </div>
    </div>

    <div class="vehiculos row">
      @foreach($vehiculos as $vehiculo)
        <div class="panel panel-success col-lg-4 col-md-6 col-sm-12">
          <div class="panel-heading">
            {{$vehiculo->tipo->nombre}} | {{$vehiculo->marca->nombre}}
          </div>
          <div class="panel-body">
            <img style="height:200px;margin:auto;" class="img img-responsive" src="{{asset('images/vehiculos/'.$vehiculo->nombreFoto)}}" alt="" />
          </div>
          <div class="panel-footer">
            <p align="center">{{$vehiculo->modelo}}</p>
            <div class="" align="center">
              <div class="panel panel-primary">Precio: ${{$vehiculo->precioAlquiler}} hora</div>
            </div>
            <div class="" align="center" style="margin-top:5px">
              {!! Form::radio('vehiculo',$vehiculo->id,['class'=>'form-control','required']) !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
    {!! $vehiculos->render() !!}

    <div class="form-group">
      <div class="col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
        <button class="btn btn-primary" type="submit" name="editar">Registrar cambios</button>
      </div>
    </div>
  {!! Form::close() !!}

@endsection
