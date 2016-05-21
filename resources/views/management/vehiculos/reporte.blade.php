@extends('management/template/main')

@section('title')
  Reporte de kilometraje
@endsection

@section('content')
  <div class="reporte-kilometraje">
    <div align="center">
      <a class="btn btn-default imprimir-reporte disabled">Imprimir reporte</a>
    </div>

    <h2 align="center">Reporte De Kilometraje</h2><br>

    <div class="row">
      <h3 align="center">Vehículos vs. kilometraje</h3>
      <div class="col-md-8 col-md-offset-2">
        <canvas id="myChart1"></canvas>
      </div>
    </div>
    <hr>
    <div class="row">
      <h3 align="center">Marcas vs. promedio de kilometraje</h3>
      <div class="col-md-8 col-md-offset-2">
        <canvas id="myChart2"></canvas>
      </div>
    </div>
    <hr>
    <div class="row">
      <h3 align="center">Tipos vs. promedio de kilometraje</h3>
      <div class="col-md-8 col-md-offset-2">
        <canvas id="myChart3"></canvas>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Placa</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Precio Alquiler</th>
            <th>kilometraje</th>
          </tr>
        </thead>
        @foreach($vehiculos as $vehiculo)
          <tbody>
            <tr>
              <td>{{$vehiculo->placa}}</td>
              <td>{{$vehiculo->marca->nombre}}</td>
              <td>{{$vehiculo->tipo->nombre}}</td>
              <td>${{$vehiculo->precioAlquiler}}</td>
              <td>{{$vehiculo->kilometraje}} Km</td>
            </tr>
          </tbody>
        @endforeach
      </table>
    </div>

  </div>
@endsection

@section('js')
  <script>
    var statechart1 = false;
    var statechart2 = false;
    var statechart3 = false;

    $(document).on('ready',function(){
      Chart.defaults.global.responsive = true;

      var urlchart1 = "";
      var urlchart2 = "";
      var urlchart3 = "";

      //Vehiculos con mas kilometraje
      $.getJSON('/management/vehiculo/topkilometraje',function(data){
        var placas = [];
        var kilometrajes = [];
        $.each(data,function(key,value){
          placas[key] = value.placa;
          kilometrajes[key] = value.kilometraje;
        });
        var ctx1 = $("#myChart1").get(0).getContext("2d");
        var data = {
                    labels: placas,
                    datasets: [
                        {
                            label: "Vehiculos vs kilometrajes",
                            fillColor: "grey",
                            strokeColor: "grey",
                            highlightFill: "#4A8496",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: kilometrajes
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
                      onAnimationComplete: function(){
                          var result = myBarChart.toBase64Image();
                          statechart1=true;
                          urlchart1 = result;
                          sensor();
                        }
                      };

        var myBarChart = new Chart(ctx1).Bar(data, options);
      });

      //Marcas vs promedio de kilometrajes
      $.getJSON('/management/marca/topmarcas',function(data){

        var marcas = [];
        var promediokilometrajes = [];
        $.each(data,function(key,value){
          marcas[key] = value.nombre;
          promediokilometrajes[key] = value.promedio;
        });

        var ctx2 = $("#myChart2").get(0).getContext("2d");

        var data = {
                    labels: marcas,
                    datasets: [
                        {
                            label: "Marcas vs promedio de kilometrajes",
                            fillColor: "brown",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: promediokilometrajes
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
                        onAnimationComplete: function(){
                            var result = myLineChart.toBase64Image();
                            statechart2=true;
                            urlchart2 = result;
                            sensor();
                          }
                    };

        var myLineChart = new Chart(ctx2).Line(data, options);
      });

      //Tipos vs promedio de kilometrajes
      $.getJSON('/management/tipo/toptipos',function(data){

        var tipos = [];
        var promediokilometrajes = [];
        $.each(data,function(key,value){
          tipos[key] = value.nombre;
          promediokilometrajes[key] = value.promedio;
        });

        var ctx3 = $("#myChart3").get(0).getContext("2d");
        var data = {
                    labels: tipos,
                    datasets: [
                        {
                            label: "Tipos vs promedio de kilometrajes",
                            fillColor: "green",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: promediokilometrajes
                        },
                    ]
                };

        var options = {
                        scaleShowLine : true,
                        angleShowLineOut : true,
                        scaleShowLabels : false,
                        scaleBeginAtZero : true,
                        angleLineColor : "rgba(0,0,0,.1)",
                        angleLineWidth : 1,
                        pointLabelFontFamily : "'Arial'",
                        pointLabelFontStyle : "normal",
                        pointLabelFontSize : 10,
                        pointLabelFontColor : "#666",
                        pointDot : true,
                        pointDotRadius : 3,
                        pointDotStrokeWidth : 1,
                        pointHitDetectionRadius : 20,
                        datasetStroke : true,
                        datasetStrokeWidth : 2,
                        datasetFill : true,
                        onAnimationComplete: function(){
                            var result = myRadarChart.toBase64Image();
                            statechart3 =true;
                            urlchart3 = result;
                            sensor();
                          }
                    };

        var myRadarChart = new Chart(ctx3).Radar(data, options);
      });

      $(".imprimir-reporte").on("click",function(){
        var vehiculoskilometraje = urlchart1;
        var marcaskilometraje = urlchart2;
        var tiposkilometraje = urlchart3;

        var doc = new jsPDF('p');
        //cabecera
        doc.setFontSize(30);
        doc.text(50, 15, 'Reporte de kilometraje.');
        doc.setFontSize(10);
        var f = new Date();
        doc.text(100,20,f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());

        //vehiculos vs kilometraje
        doc.text(15, 35, 'Top de vehiculos con más kilometraje.');
        doc.addImage(vehiculoskilometraje, 'JPEG', 15, 40, 180, 100);

        //marcas vs kilometraje
        doc.text(15, 155, 'Top de marcas con mayor promedio de kilometraje.');
        doc.addImage(marcaskilometraje, 'JPEG', 15, 160, 180, 100);

        doc.addPage();
        //tipos vs kilometraje
        doc.text(15, 15, 'Top de tipos con mayor promedio de kilometraje.');
        doc.addImage(tiposkilometraje, 'JPEG', 15, 20, 180, 100);

        //listado de vehiculos
        doc.setFontSize(15);
        doc.text(80, 150, 'Listado de vehiculos.');
        doc.setFontSize(10);

        $.getJSON("/management/vehiculo/allvehicles",function(data){
          var columns = [
              {title: "Placa", dataKey: "placa"},
              {title: "Marca", dataKey: "marca"},
              {title: "Tipo", dataKey: "tipo"},
              {title: "Precio", dataKey: "precio"},
              {title: "Kilometraje", dataKey: "kilometraje"},
          ];
          var rows = [];
          $.each(data,function(index, val) {
            rows[index] = {"placa": val.placa, "marca": val.marca.nombre, "tipo": val.tipo.nombre, "precio": val.precioAlquiler, "kilometraje": val.kilometraje};
          });
          doc.autoTable(columns, rows,{
                      theme: 'striped',
                      styles: {
                          cellPadding:0,
                          halign: 'center', // left, center, right
                          valign: 'middle', // top, middle, bottom
                          fillStyle: 'F', // 'S', 'F' or 'DF' (stroke, fill or fill then stroke)
                          rowHeight: 10,
                          overflow: 'linebreak',
                      },
                      headerStyles: {},
                      bodyStyles: {},
                      alternateRowStyles: {},
                      columnStyles: {
                        placa: {columnWidth: 35},
                        marca: {columnWidth: 50},
                        tipo: {columnWidth: 50},
                        precio: {columnWidth: 30},
                      },

                      startY: 160, // false (indicates margin top value) or a number
                      margin: {horizontal: 3}, //a number, array or object
                      pageBreak: 'auto',
                      tableWidth: 203, // 'auto', 'wrap' or a number,
                   });

          doc.save("ReporteKilometraje.pdf");
        });
      });

    });

    function sensor(param){
      if (statechart1 == true && statechart2 == true && statechart3 == true) {
        $(".imprimir-reporte").removeClass("disabled");
      }
    }
  </script>
@endsection
