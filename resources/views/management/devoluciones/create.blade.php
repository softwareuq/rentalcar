@extends('management/template/main')

@section('title')
  Lista de devoluciones
@endsection

@section('content')

  <div class="" align="center">
    <h2>Registrar devolución</h2>
  </div>

  <div class="panel panel-default">
    <br>
    {!! Form::open(['route'=>['management.devoluciones.store',$renta],'method'=>'POST','class'=>'form-horizontal']) !!}
      <div class="form-group">
        <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="kilometraje">kilometraje:</label>
        <div class="col-sm-3 col-md-3">
          <input class="form-control" type="number" name="kilometraje" value="" placeholder="Kilometraje" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="estadoVehiculo">Estado:</label>
        <div class="col-sm-3 col-md-3">
          <input class="form-control" type="text" name="estadoVehiculo" value="" placeholder="Estado" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="observaciones">Observaciones:</label>
        <br><br>
        <div class="col-sm-3 col-sm-offset-5 col-md-8 col-md-offset-2" align="center">
          <textarea name="observaciones" class="form-control" rows="5"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
          <button class="btn btn-primary" type="submit" name="enviar">Registrar</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>


@endsection
