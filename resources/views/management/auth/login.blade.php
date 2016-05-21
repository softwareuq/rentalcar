@extends('management/auth/main')

@section('title')
  Inicar sesion
@endsection

@section('content')
<div class="wrapper-page">
  <div class=" card-box">
    <div class="panel-heading">
        <h3 class="text-center"> Sign In to <strong class="text-custom">RentalCar</strong> </h3>
    </div>
    <div class="panel-body">
      {!! Form::open(['route'=>'management.auth.login','method'=>'POST','class'=>'form-horizontal m-t-20']) !!}

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="email" name="email" value="" placeholder="Correo" required>
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
            <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit" name="enviar">Ingresar</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 text-center">
      <p>Don't have an account? <a href="{{route('management.auth.create')}}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
    </div>
  </div>
</div>
@endsection
