@extends('management/auth/main')

@section('title')
  Registrarse
@endsection

@section('content')
<div class="wrapper-page">
  <div class=" card-box">
    <div class="panel-heading">
        <h3 class="text-center"> Creación de cuenta <strong class="text-custom">RentalCar</strong> </h3>
    </div>
    <div class="panel-body">
      {!! Form::open(['route'=>'management.auth.store','method'=>'POST','class'=>'form-horizontal m-t-20']) !!}

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="number" name="cedula" value="" placeholder="Cedula" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="name" value="" placeholder="Nombre" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="telefono" value="" placeholder="Telefono" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="direccion" value="" placeholder="Direccion">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="email" name="email" value="" placeholder="Email" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password" value="" placeholder="Password" required>
          </div>
        </div>

        <br>
        <div class="form-group">
          <div class="col-xs-12">
            <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit" name="enviar">Registrarse</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 text-center">
      <p>Ya tengo una cuenta<a href="{{route('management.auth.login')}}" class="text-primary m-l-5"><b>Sign In</b></a></p>
    </div>
  </div>
</div>
@endsection
