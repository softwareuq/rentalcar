@extends('management/template/main')

@section('title')
  Lista de Usuarios
@endsection

@section('content')

@if(Auth::user()->admin())
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-primary">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Registrar un nuevo usuario
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          {!! Form::open(['route'=>'management.users.store','method'=>'POST','class'=>'form-horizontal']) !!}
            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="cedula">Cedula:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="number" name="cedula" value="" placeholder="Cedula" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="name">Nombre:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="text" name="name" value="" placeholder="Nombre" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="telefono">Telefono:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="text" name="telefono" value="" placeholder="Telefono" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="direccion">Direccion:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="text" name="direccion" value="" placeholder="Direccion">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="options">Tipo:</label>
              <div class="col-sm-3 col-md-3">
                <select class="options form-control" name="tipo" required>
                <option value="cliente">Seleccione un tipo</option>
                <option value="cliente">Cliente</option>
                <option value="administrador">Administrador</option>
              </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="email">Email:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="email" name="email" value="" placeholder="Email" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="password">Password:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="password" name="password" value="" placeholder="Password" required>
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
    </div>
  </div>
@endif

  <hr>
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Identificacion</th>
        <th>Nombre</th>
        <th>Telefono</th>
        @if(Auth::user()->admin())
        <th>Tipo</th>
        @endif
        <th>Horas Acumuladas</th>
        <th>Email</th>
        <th>Editar</th>
        @if(Auth::user()->admin())
        <th>Eliminar</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($usuarios as $usuario)
        @if(Auth::user()->cliente() and $usuario->id == Auth::user()->id)
          <tr>
            <td>{{$usuario->cedula}}</td>
            <td>{{$usuario->name}}</td>
            <td>{{$usuario->telefono}}</td>
            <td>{{$usuario->horasAcumuladas}}</td>
            <td>{{$usuario->email}}</td>
            <td><a href=" {{ route('management.users.edit',$usuario->id) }} " class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
          </tr>
        @endif

        @if(Auth::user()->admin())
        <tr>
          <td>{{$usuario->cedula}}</td>
          <td>{{$usuario->name}}</td>
          <td>{{$usuario->telefono}}</td>
          <td>{{$usuario->tipo}}</td>
          <td>{{$usuario->horasAcumuladas}}</td>
          <td>{{$usuario->email}}</td>
          <td><a href=" {{ route('management.users.edit',$usuario->id) }} " class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
          <td><a href=" {{ route('management.users.destroy',$usuario->id) }} " class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        @endif
      @endforeach
    </tbody>
  </table>

  @if(Auth::user()->admin())
    {!! $usuarios->render() !!}
  @endif
@endsection
