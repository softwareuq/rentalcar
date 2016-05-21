<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Requests\MarcaRequest;

class MarcasController extends Controller
{

  public function index(){
    $marcas = Marca::orderBy('id','ASC')->paginate(20);
    return view('management/marcas/index',['marcas'=>$marcas]);
  }

  public function store(MarcaRequest $request){
    $marca = new Marca();
    $marca->nombre=$request->nombre;

    $marca->save();

    Flash::success('Marca '.$marca->nombre.' creada');
    return redirect()->route('management.marcas.index');
  }

  public function destroy($id){
    $marca = Marca::find($id);
    $marca->delete();

    Flash::warning('Marca '.$marca->nombre.' eliminada');
    return redirect()->route('management.marcas.index');
  }

  public function edit($id){
    $marca = Marca::find($id);
    return view('management/marcas/edit',['marca'=>$marca]);
  }

  public function update(MarcaRequest $request,$id){
    $marca = Marca::find($id);
    $marca->nombre = $request->nombre;

    $marca->save();

    Flash::info('Marca '.$marca->nombre.' actualizada');
    return redirect()->route('management.marcas.index');
  }

  public function kilometraje(){
    $marcas = Marca::topMarcas();
    return response()->json($marcas);
  }

}
