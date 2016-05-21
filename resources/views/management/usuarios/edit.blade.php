@extends('management/template/main')

@section('title')
  Editar datos de usuario {{$usuario->nombre}}
@endsection

@section('content')

  {!! Form::open(['route'=>['management.users.update',$usuario],'method'=>'PUT','class'=>'form-horizontal']) !!}

    @if(Auth::user()->cliente())
    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3 hidden" for="cedula">Cedula:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="hidden" name="cedula" value="{{$usuario->cedula}}" required>
      </div>
    </div>
    @endif

    @if(Auth::user()->admin())
    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="cedula">Cedula:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="number" name="cedula" value="{{$usuario->cedula}}" required>
      </div>
    </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="name">Nombre:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="name" value="{{$usuario->name}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="telefono">Telefono:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="telefono" value="{{$usuario->telefono}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="direccion">Direccion:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="direccion" value="{{$usuario->direccion}}">
      </div>
    </div>

    @if(Auth::user()->admin())
    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="options">Tipo:</label>
      <div class="col-sm-3 col-md-3">
        <select class="options form-control" name="tipo" required>
          @if($usuario->tipo =='cliente')
            <option value="cliente">Seleccione un tipo</option>
            <option selected value="cliente">Cliente</option>
            <option value="administrador">Administrador</option>
          @elseif($usuario->tipo == 'administrador')
            <option value="cliente">Seleccione un tipo</option>
            <option value="cliente">Cliente</option>
            <option selected value="administrador">Administrador</option>
          @endif
      </select>
      </div>
    </div>
    @endif

    @if(Auth::user()->cliente())
    <div class="form-group hidden">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="options">Tipo:</label>
      <div class="col-sm-3 col-md-3">
        <select class="options form-control" name="tipo" required>
          @if($usuario->tipo =='cliente')
            <option value="cliente">Seleccione un tipo</option>
            <option selected value="cliente">Cliente</option>
            <option value="administrador">Administrador</option>
          @elseif($usuario->tipo == 'administrador')
            <option value="cliente">Seleccione un tipo</option>
            <option value="cliente">Cliente</option>
            <option selected value="administrador">Administrador</option>
          @endif
      </select>
      </div>
    </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="email">Email:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="email" name="email" value="{{$usuario->email}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="password">Password:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="password" name="password" value="{{$usuario->password}}" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
        <button class="btn btn-primary" type="submit" name="editar">Registrar cambios</button>
      </div>
    </div>
  {!! Form::close() !!}

@endsection
