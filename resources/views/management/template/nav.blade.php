<header class="main-header">
  <a href="{{route('front.index')}}" class="logo" style="position:fixed">
    <span class="logo-mini"><b>R</b>Car</span>
    <span class="logo-lg"><b>Rental</b>Car</span>
  </a>

  <nav class="navbar navbar-fixed-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          @if(Auth::user())
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;{{Auth::user()->name}}&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('management.auth.logout')}}" style="color:black">Cerrar sesion</a></li>
          </ul>
          @endif
        </li>
      </ul>
    </div>
  </nav>
</header>
