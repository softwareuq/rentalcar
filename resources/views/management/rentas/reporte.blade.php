@extends('management/template/main')

@section('title')
  Reporte de rentas
@endsection

@section('content')
  <div class="reporte-rentas">
    <div align="center">
      <a class="btn btn-default imprimir-reporte disabled">Imprimir reporte</a>
    </div>

    <h2 align="center">Reporte De Rentas</h2><br>

    <div class="periodo panel panel-default" style="padding:4px;">
      <h4><strong>Periodo</strong></h4>
      <hr>
      <div class="intervalo">
        <div class="fecha-inicial row">
          <div class="col-md-2">
            <label for="fechainicial">Fecha Inicio</label>
          </div>
          <div class="col-md-3">
            <input type="date" name="fechainicial" class="form-control fechainicial">
          </div>
        </div>
        <br>
        <div class="fecha-final row">
          <div class="col-md-2">
            <label for="fechafinal">Fecha Final:</label>
          </div>
          <div class="col-md-3">
            <input type="date" name="fechafinal" class="form-control fechafinal">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3">
            <a href="javascript:void(0)" class="btn btn-primary boton-reporte">Actualizar reporte</a>
          </div>
        </div>
        <br>
      </div>
    </div>

    <br>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Cod. Renta</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Vehiculo</th>
            <th>Precio Alquiler</th>
          </tr>
        </thead>
        <tbody class="reporte-body">

        </tbody>
      </table>
    </div>
  </div>
@endsection


@section('js')
  <script type="text/javascript">
    $(document).on("ready",function(){

      var rentas = [];
      var rentasfecha = [];
      var flagfecha= false;
      $.getJSON("/management/renta/getrentas",function(data){
        //llamar a un metodo para limpiar data de las rentas no entregadas copia
        rentas = clearDataState(data);
        $(".boton-reporte").addClass("disabled");
        var html = "";
        $.each(rentas,function(key,value){
          html += "<tr>" +
                    "<td>" + value.id + "</td>" +
                    "<td>" + value.fecha + "</td>" +
                    "<td>" + value.usuario.cedula + "</td>" +
                    "<td>" + value.vehiculo.placa + "</td>" +
                    "<td>" + value.vehiculo.precioAlquiler + "</td>" +
                  "</tr>";
        });
        $(".reporte-body").html(html);
        $(".boton-reporte").removeClass("disabled");
        $(".imprimir-reporte").removeClass("disabled");
      });

      $(".boton-reporte").on("click",function(){
        $(".boton-reporte").addClass("disabled");
        $(".imprimir-reporte").addClass("disabled");

        var fechainicio = $(".fechainicial").val();
        var fechafinal = $(".fechafinal").val();

        if(fechainicio != "" && fechafinal != ""){
          fechainicio = formatDate(fechainicio);
          fechafinal = formatDate(fechafinal);

          if (fechafinal >= fechainicio) {
            rentasfecha = clearDate(fechainicio,fechafinal,rentas);
            flagfecha = true;
            var html = "";
            for (var i = 0; i < rentasfecha.length; i++) {
              html += "<tr>" +
                        "<td>" + rentas[i].id + "</td>" +
                        "<td>" + rentas[i].fecha + "</td>" +
                        "<td>" + rentas[i].usuario.cedula + "</td>" +
                        "<td>" + rentas[i].vehiculo.placa + "</td>" +
                        "<td>" + rentas[i].vehiculo.precioAlquiler + "</td>" +
                      "</tr>";
            }
            $(".reporte-body").html(html);

          }else{
            alert("El intervalo de fechas no es valido");
          }
        }
        $(".boton-reporte").removeClass("disabled");
        $(".imprimir-reporte").removeClass("disabled");
      });


      //Evento de impresion
      $(".imprimir-reporte").on("click",function(){
        if(flagfecha){
          imprimirReporte(rentasfecha,"periodo");
        }else{
          imprimirReporte(rentas,"none");
        }
      });

    });

    function getDateFromPhp(fecha){
      var parts = fecha.split(" ");
      var parts1 = parts[0].split("-");
      var date = new Date(parts1[0],parts1[1]-1,parts1[2]);
      return date;
    }

    function formatDate(fecha){
      var parts = fecha.split("-");
      var date = new Date(parts[0],parts[1]-1,parts[2]);
      return date;
    }

    function clearDataState(data){
      var datos = [];
      var iterator = 0;
      for (var i = 0; i < data.length; i++) {
        if(data[i].estado == "entregado"){
          datos[iterator] = data[i];
          iterator = iterator + 1;
        }
      }
      return datos;
    }

    function clearDate(fechainicio,fechafinal,rentas){
      var datos = [];
      var iterator = 0;
      for (var i = 0; i < rentas.length; i++) {
        if(getDateFromPhp(rentas[i].fecha) >= fechainicio && getDateFromPhp(rentas[i].fecha) <= fechafinal){
          datos[iterator] = rentas[i];
          iterator = iterator + 1;
        }
      }
      return datos;
    }

    function imprimirReporte(rentas,periodo){
      var doc = new jsPDF('p');
      doc.setFontSize(30);
      doc.text(60, 15, 'Reporte de rentas.');
      doc.setFontSize(10);

      if(periodo == "periodo"){
        var fechainicio = $(".fechainicial").val();
        var fechafinal = $(".fechafinal").val();
        doc.text(75, 25, 'Periodo: ' + fechainicio + " - " + fechafinal);
        var f = new Date();
        doc.text(95, 30,f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
      }else{
        var f = new Date();
        doc.text(95, 25,f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
      }

      var columns = [
          {title: "Cod. Renta", dataKey: "codrenta"},
          {title: "Fecha", dataKey: "fecha"},
          {title: "Cliente", dataKey: "cliente"},
          {title: "Vehiculo", dataKey: "vehiculo"},
          {title: "Precio", dataKey: "precio"},
      ];
      var rows = [];
      $.each(rentas,function(index, val) {
        rows[index] = {"codrenta": val.id, "fecha": val.fecha, "cliente": val.usuario.cedula, "vehiculo": val.vehiculo.placa, "precio": val.vehiculo.precioAlquiler};
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
                    codrenta: {columnWidth: 25},
                    fecha: {columnWidth: 55},
                    cliente: {columnWidth: 55},
                    vehiculo: {columnWidth: 35},
                  },

                  startY: 40, // false (indicates margin top value) or a number
                  margin: {horizontal: 3}, //a number, array or object
                  pageBreak: 'auto',
                  tableWidth: 203, // 'auto', 'wrap' or a number,
               });

      doc.save("ReporteRentas.pdf");
    }
  </script>
@endsection
