<aside class="main-sidebar" style="position:fixed">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li><a href="{{route('management.index')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li><a href="{{route('management.rentas.index')}}"><i class="fa fa-credit-card"></i> <span>@if(Auth::user()->cliente())Mis @endif Rentas</span></a></li>
      @if(Auth::user()->admin())
      <li><a href="{{route('management.devoluciones.index')}}"><i class="fa fa-undo"></i> <span>Devoluciones</span></a></li>
      <li><a href="{{route('management.users.index')}}"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
      @endif
      <li><a href="{{route('management.vehiculos.index')}}"><i class="fa fa-car"></i> <span>Vehiculos</span></a></li>
      @if(Auth::user()->admin())
      <li><a href="{{route('management.marcas.index')}}"><i class="fa fa-map-pin"></i> <span>Marcas</span></a></li>
      <li><a href="{{route('management.tipos.index')}}"><i class="fa fa-link"></i> <span>Tipos</span></a></li>
      @endif
      @if(Auth::user()->cliente())
      <li><a href="{{route('management.users.index')}}"><i class="fa fa-users"></i> <span>Mi Cuenta</span></a></li>
      @endif
    </ul>
  </section>
</aside>
