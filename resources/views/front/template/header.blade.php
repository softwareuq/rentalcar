<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('front.index')}}"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;RentalCar</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i><span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(Auth::user())
              <li><a href="{{route('management.auth.login')}}">Mi Cuenta</a></li>
            @else
              <li><a href="{{route('management.auth.login')}}">Iniciar sesion</a></li>
            @endif
            <li role="separator" class="divider"></li>
            <li><a id="demo01" href="#animatedModal">Sobre nosotros</a></li>
            <li><a href="javascript:void(0)" id="contacto">Contacto</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div id="animatedModal">
    <div class="close-animatedModal">
        <div class="" align="center">
          <a href="javascript:void(0)"><i class="fa fa-times-circle fa-3x" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="container">
      <strong align="center"><h2>¿Quienes somos?</h2></strong>

      <p align="justify">
        <strong>RentalCar</strong> es una empresa legalmente constituida en la Cámara de Comercio Armenia,
        con su respectivo Registro Nacional de Turismo No.xxxx. Cuyo objeto social es el alquiler de vehículos en todas sus gamas.
      </p>

      <p align="justify">
        <strong>Misión</strong>
        <br>
        Ejercer una correcta Administración, Fiscalización, Control, Determinación y Liquidación
        de los Impuestos y Rentas de la organizacion, brindando seguridad jurídica a los Clientes y
        del departamento del Quindio, y a su vez garantizando la generación de Ingresos para el
        fortalecimiento financiero de empresa.
        <br><br>
        <strong>Visión</strong>
        <br>
        Ser en el 2016 una de las mejores empresas en prestacion de servicios de renta vehicular en el pais, que
        genere confianza en el Contribuyente permitiendo incrementar los ingresos
        mediante la conformación de un Equipo de Trabajo con excelentes condiciones Humanas y
        sólidos conocimientos, que permitan ejercer liderazgo y generen confianza
        ante los Clientes, basados en los principios de Lealtad, Disciplina, Responsabilidad,
        Compromiso, Creatividad, Confiabilidad, Transparencia y Servicio.
      </p>
    </div>

    <div class="equipo">
      <div class="row" align="center">
        <div class="col-md-4">
          <h3>Ricardo Ayala</h3>
          <img class="img img-responsive img-circle" src="{{asset('images/icon/faviconpanel.ico')}}" alt="" />
        </div>
        <div class="col-md-4">
          <h3>Roy López</h3>
          <img class="img img-responsive img-circle" src="{{asset('images/icon/faviconpanel.ico')}}" alt="" />
        </div>
        <div class="col-md-4">
          <h3>Ludwin Buitrago</h3>
          <img class="img img-responsive img-circle" src="{{asset('images/icon/faviconpanel.ico')}}" alt="" />
        </div>
      </div>

      <div class="row" align="center">
        <div class="col-md-4 col-md-offset-2">
          <h3>David Hernandez</h3>
          <img class="img img-responsive img-circle" src="{{asset('images/icon/faviconpanel.ico')}}" alt="" />
        </div>
        <div class="col-md-4">
          <h3>Camilo Gonzales</h3>
          <img class="img img-responsive img-circle" src="{{asset('images/icon/faviconpanel.ico')}}" alt="" />
        </div>
      </div>
    </div>

</div>


@section('js')
  <script type="text/javascript">
    $(document).on("ready",function(){

      $("#contacto").on("click",function(){
        var posicion = $("#contact").position();
        $('html,body').animate({
            scrollTop: posicion.top,
        }, 700);
      });

      $("#demo01").animatedModal({
        color: '#008B8B',
        animatedIn:'zoomInDown',
        animatedOut:'bounceOut',
      });

    });
  </script>
@endsection
