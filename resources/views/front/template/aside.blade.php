<div class="aside" style="width:100%;padding:0px;">
  <div class="aside">

    <div class="tipos">
      <div class="list-group hidden-md hidden-sm hidden-xs">
        <a class="list-group-item active ">
          Tipos
        </a>
        @foreach($tipos as $tipo)
          <a href="{{route('front.search.tipo',$tipo->id)}}" class="list-group-item">{{$tipo->nombre}}</a>
        @endforeach
      </div>
    </div>

    <div class="marcas">
      <div class="list-group hidden-md hidden-sm hidden-xs">
        <a class="list-group-item active ">
          Marcas
        </a>
        @foreach($marcas as $marca)
          <a href="{{route('front.search.marca',$marca->id)}}" class="list-group-item">{{$marca->nombre}}</a>
        @endforeach
      </div>
    </div>

  </div>
</div>
