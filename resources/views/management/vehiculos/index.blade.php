@extends('management/template/main')

@section('title')
  Lista de Vehiculos
@endsection

@section('content')

  @if(Auth::user()->admin())
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-primary">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Registrar un nuevo vehiculo
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">

          {!! Form::open(['route'=>'management.vehiculos.store','method'=>'POST','files' => true,'class'=>'form-horizontal']) !!}
            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="placa">Placa:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="text" name="placa" value="" placeholder="Placa" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="category_id">Marca:</label>
              <div class="col-sm-3 col-md-3">
                {!! Form::select('marca_id',$marcas,null,['class'=>'form-control select-marca','required']) !!}
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="category_id">Tipo:</label>
              <div class="col-sm-3 col-md-3">
                {!! Form::select('tipo_id',$tipos,null,['class'=>'form-control select-tipo','required']) !!}
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="precioAlquiler">Precio por hora:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="number" name="precioAlquiler" value="" placeholder="Precio de alquiler" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="capacidad">Capacidad:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="number" name="capacidad" value="" placeholder="Capacidad" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="modelo">Modelo:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="text" name="modelo" value="" placeholder="Modelo" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="color">Color:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="text" name="color" value="" placeholder="Color" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-3" for="kilometraje">Kilometraje:</label>
              <div class="col-sm-3 col-md-3">
                <input class="form-control" type="number" step="any" name="kilometraje" value="" placeholder="Kilometraje" required>
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

  <div class="catalogo-vehiculos">
    <div class="titulo">
      <h2>Catalogo de vehiculos</h2>
    </div>
    <div class="row">
      <div class="search col-md-6">
        {!! Form::open(['route'=>'management.vehiculos.index','method'=>'GET','class'=>'navbar-form']) !!}
          <div class="form-group">
              <div>
                <input type="text" class="form-control" placeholder="Search for..." name="search">
                {!! Form::select('tipo',array('Marca' => 'Marca', 'Tipo' => 'Tipo','Color' => 'Color','Modelo' => 'Modelo','Placa' => 'Placa','Precio' => 'Precio','Capacidad' => 'Capacidad','Disponibilidad' => 'Disponibilidad'),'Marca',['class'=>'form-control','required']) !!}
                <button class="btn btn-default" type="submit">Go!</button>
              </div>
          </div>
        {!! Form::close() !!}
      </div>
      @if(Auth::user()->admin())
      <div class="reporte-kilometraje col-md-6" align="right">
        <a href="{{ route('management.vehiculos.reporte') }}" class="btn btn-success">Reporte de kilometraje</a>
      </div>
      @endif
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
            <div class="panel panel-default" align="center">
              {{$vehiculo->modelo}}
            </div>
            @if(Auth::user()->cliente())
              <div class="" align="center">
                @if($vehiculo->disponible==1)
                  <a href="{{route('management.rentas.store',$vehiculo)}}" class="btn btn-primary">Rentar por ${{$vehiculo->precioAlquiler}} hora</a>
                @else
                  <a disabled class="btn btn-primary">Rentar por ${{$vehiculo->precioAlquiler}} hora</a>
                @endif
              </div>
            @endif

            @if(Auth::user()->admin())
              <div class="" align="center" style="margin-top:5px">
                <div class="btn-group" role="group" aria-label="">
                  <a href=" {{ route('management.vehiculos.destroy',$vehiculo->id) }} " class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  <a href=" {{ route('management.vehiculos.edit',$vehiculo->id) }} " class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  <a href="misma que la imagen" class="btn btn-default"><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                </div>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
  {!! $vehiculos->render() !!}

@endsection
