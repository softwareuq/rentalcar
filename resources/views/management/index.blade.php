@extends('management/template/main')

@section('title')
  Inicio
@endsection

@section('content')
  <div class="">
    @if(Auth::user()->cliente())
      <div class="row">
        <div class="col-md-2 col-md-offset-5">
          <img class="img img-responsive" src="{{asset('images/icon/faviconpanel.ico')}}" alt="" />
        </div>
      </div>
    @endif

    <h2 align="center">Bienvenido a RentalCar: Sistema de renta vehicular.</h2>

    @if(Auth::user()->admin())
      <div class="row">
        <h3 align="center">Top usuarios con mas rentas</h3>
        <div class="col-md-8 col-md-offset-2">
          <canvas id="myChart1"></canvas>
        </div>
      </div>
      <hr>
      <div class="row">
        <h3 align="center">Top vehiculos mas rentados</h3>
        <div class="col-md-8 col-md-offset-2">
          <canvas id="myChart2"></canvas>
        </div>
      </div>
    @endif

    @if(Auth::user()->cliente())
      <div class="row" style="padding:50px;">
        <h3>Hola {{Auth::user()->name}}</h3>
        <h4>Para obtener ayuda e informacion sobre procesos de renta comuniquese
          a nuestra linea o realice la lectura de la informacion pertinente en nuestra seccion de ayuda
        </h4>
        <div class="informacion" align="justify">
          <p>
            Somos una rentadora de vehiculos reconocida por su inquebrantable busqueda en
             soluciones de movilidad para ti, tu empresa y tu familia. Tenemos ofertas permanentes para
             ti y en el eventual caso de no tener tu carro de alquiler,
             buscaremos la mejor oferta dentro de nuestro selecto grupo de proveedores.
          </p>
          <p>
            <strong>Entregan los vehículos en el aeropuerto de la ciudad destino?</strong>
            <br>
            Sí, le entregamos su vehículo en el aeropuerto si así lo desea, en todas las ciudades donde tenemos servicio una persona lo esperara con un cartel con logo de Milano Rent a Car y/o el de su aliado estratégico que lo guíara para hacerle entrega de su vehículo.
            <br><br>
            <strong>Puedo recibir el vehículo en una ciudad y entregarlo en otra?</strong>
            <br>
            Sí, es posible hacer esto, siempre y cuando lo manifieste con anterioridad y pague el recargo correspondiente por el servicio. (Aplican restricciones).
          </p>
        </div>
      </div>
    @endif

  </div>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).on("ready",function(){
      Chart.defaults.global.responsive = true;

      $.getJSON('/management/user/topusers',function(data){
        var users = [];
        var rentas = [];
        $.each(data,function(key,value){
          users[key] = value.cedula;
          rentas[key] = value.num_rentas;
        });

        var ctx1 = $("#myChart1").get(0).getContext("2d");
        var data = {
                    labels: users,
                    datasets: [
                        {
                            label: "Vehiculos vs kilometrajes",
                            fillColor: "grey",
                            strokeColor: "grey",
                            highlightFill: "#4A8496",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: rentas
                        },
                    ]
                };

        var options = {
                      scaleBeginAtZero : true,
                      scaleShowGridLines : true,
                      scaleGridLineColor : "rgba(0,0,0,.05)",
                      scaleGridLineWidth : 1,
                      scaleShowHorizontalLines: true,
                      scaleShowVerticalLines: true,
                      barShowStroke : true,
                      barStrokeWidth : 2,
                      barValueSpacing : 5,
                      barDatasetSpacing : 1,
                      };

        var myBarChart = new Chart(ctx1).Bar(data, options);
      });

      //top vehiculos mas rentados
      $.getJSON('/management/vehiculo/topvehiculos',function(data){

        var placas = [];
        var rentas = [];
        $.each(data,function(key,value){
          placas[key] = value.placa;
          rentas[key] = value.num_rentas;
        });

        var ctx2 = $("#myChart2").get(0).getContext("2d");

        var data = {
                    labels: placas,
                    datasets: [
                        {
                            label: "Marcas vs promedio de kilometrajes",
                            fillColor: "#A1D490",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: rentas
                        }
                    ]
                };

        var options = {
                        scaleShowGridLines : true,
                        scaleGridLineColor : "rgba(0,0,0,.05)",
                        scaleGridLineWidth : 1,
                        scaleShowHorizontalLines: true,
                        scaleShowVerticalLines: true,
                        bezierCurve : true,
                        bezierCurveTension : 0.4,
                        pointDot : true,
                        pointDotRadius : 4,
                        pointDotStrokeWidth : 1,
                        pointHitDetectionRadius : 20,
                        datasetStroke : true,
                        datasetStrokeWidth : 2,
                        datasetFill : true,
                    };

        var myLineChart = new Chart(ctx2).Line(data, options);
      });

    });
  </script>
@endsection
