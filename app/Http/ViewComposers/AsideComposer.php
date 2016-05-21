<?php

  namespace App\Http\ViewComposers;
  use Illuminate\Contracts\View\View;
  use App\Tipo;
  use App\Marca;

  class AsideComposer
  {

    public function compose(View $view){
      //limitar los tipos y las marcas que se van a mostrar
      $tipos = Tipo::orderByRaw("RAND()")->take(10)->get();
      $marcas = Marca::orderByRaw("RAND()")->take(10)->get();

      $view->with(['tipos'=>$tipos,'marcas'=>$marcas]);
    }

  }

 ?>
