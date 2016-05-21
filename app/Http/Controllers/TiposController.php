<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Requests\TipoRequest;

class TiposController extends Controller
{
  public function index(){
    $tipos = Tipo::orderBy('id','ASC')->paginate(20);
    return view('management/tipos/index',['tipos'=>$tipos]);
  }

  public function store(TipoRequest $request){
    $tipo = new Tipo();
    $tipo->nombre=$request->nombre;

    $tipo->save();

    Flash::success('Tipo '.$tipo->nombre.' creado');
    return redirect()->route('management.tipos.index');
  }

  public function destroy($id){
    $tipo = Tipo::find($id);
    $tipo->delete();

    Flash::warning('Tipo '.$tipo->nombre.' eliminado');
    return redirect()->route('management.tipos.index');
  }

  public function edit($id){
    $tipo = Tipo::find($id);
    return view('management/tipos/edit',['tipo'=>$tipo]);
  }

  public function update(TipoRequest $request,$id){
    $tipo = Tipo::find($id);
    $tipo->nombre = $request->nombre;

    $tipo->save();

    Flash::info('Tipo '.$tipo->nombre.' actualizado');
    return redirect()->route('management.tipos.index');
  }

  public function kilometraje(){
    $tipos = Tipo::topTipos();
    return response()->json($tipos);
  }
}
