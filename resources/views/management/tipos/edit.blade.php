@extends('management/template/main')

@section('title')
  Editar Tipo {{$tipo->nombre}}
@endsection

@section('content')

  {!! Form::open(['route'=>['management.tipos.update',$tipo],'method'=>'PUT','class'=>'form-horizontal']) !!}
    <div class="form-group">
      <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="nombre">Nombre:</label>
      <div class="col-sm-3 col-md-3">
        <input class="form-control" type="text" name="nombre" value="{{$tipo->nombre}}" placeholder="Nombre" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
        <button class="btn btn-primary" type="submit" name="editar">Editar</button>
      </div>
    </div>
  {!! Form::close() !!}

@endsection
