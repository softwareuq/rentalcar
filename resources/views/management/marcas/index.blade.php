@extends('management/template/main')

@section('title')
  Lista de Marcas
@endsection

@section('content')

  <div class="panel panel-primary">
    <div class="panel-heading">Registrar una nueva marca</div>
    <div class="panel-body">
      {!! Form::open(['route'=>'management.marcas.store','method'=>'POST','class'=>'form-horizontal']) !!}
        <div class="form-group">
          <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="name">Nombre:</label>
          <div class="col-sm-3 col-md-3">
            <input class="form-control" type="text" name="nombre" value="" placeholder="Nombre" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
            <button class="btn btn-primary" type="submit" name="enviar">Registrar</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

  <br>
  <hr>
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Editar</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
      @foreach($marcas as $marca)
        <tr>
          <td>{{$marca->id}}</td>
          <td>{{$marca->nombre}}</td>
          <td><a href=" {{ route('management.marcas.edit',$marca->id) }} " class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
          <td><a href=" {{ route('management.marcas.destroy',$marca->id) }} " class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $marcas->render() !!}

@endsection
