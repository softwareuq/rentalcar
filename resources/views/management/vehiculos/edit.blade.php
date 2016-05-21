@extends('management/template/main')

@section('title')
  Editar datos de vehiculo {{$vehiculo->placa}}
@endsection

@section('content')

  {!! Form::open(['route'=>['management.vehiculos.update',$vehiculo],'method'=>'PUT','files' => true,'class'=>'form-horizontal']) !!}
    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="placa">Placa:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="placa" value="{{$vehiculo->placa}}" placeholder="Placa" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="marca_id">Marca:</label>
      <div class="col-sm-3 col-md-3">
        {!! Form::select('marca_id',$marcas,$vehiculo->marca->id,['class'=>'form-control select-marca','required']) !!}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="tipo_id">Tipo:</label>
      <div class="col-sm-3 col-md-3">
        {!! Form::select('tipo_id',$tipos,$vehiculo->tipo->id,['class'=>'form-control select-tipo','required']) !!}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="precioAlquiler">Precio por hora:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="number" name="precioAlquiler" value="{{$vehiculo->precioAlquiler}}" placeholder="Precio de alquiler" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="capacidad">Capacidad:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="number" name="capacidad" value="{{$vehiculo->capacidad}}" placeholder="Capacidad" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="modelo">Modelo:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="modelo" value="{{$vehiculo->modelo}}" placeholder="Modelo" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="color">Color:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="color" value="{{$vehiculo->color}}" placeholder="Color" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="kilometraje">Kilometraje:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="number" step="any" name="kilometraje" value="{{$vehiculo->kilometraje}}" placeholder="Kilometraje" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="tipo_id">Disponible:</label>
      <div class="col-sm-3 col-md-3">
        {!! Form::select('disponible', array(1 => 'Si', 0 => 'No'), 1,['class'=>'form-control select-disponible','required']) !!}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="foto">Imagen:</label>
      <div class="col-sm-3 col-md-3">
        {!! Form::file('foto')!!}
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
        <button class="btn btn-primary" type="submit" name="enviar">Registrar Cambios</button>
      </div>
    </div>
  {!! Form::close() !!}

@endsection
