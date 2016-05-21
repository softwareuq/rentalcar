<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tipo;
use App\Marca;
use App\Vehiculo;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Requests\UsuarioRequest;

class FrontController extends Controller
{
  public function createClient(){
    return view('management/auth/register');
  }

  public function storeClient(UsuarioRequest $request){
    $usuario = new User();
    $usuario->cedula=$request->cedula;
    $usuario->name=$request->name;
    $usuario->licencia=$request->cedula;
    $usuario->telefono=$request->telefono;
    $usuario->direccion=$request->direccion;
    $usuario->horasAcumuladas=0;
    $usuario->email=$request->email;
    $usuario->password=bcrypt($request->password);

    $usuario->save();

    Flash::success('Usuario '.$usuario->nombre.' registrado, ahora puede iniciar sesion');
    return redirect()->route('management.auth.login');
  }

  public function index(){
    $vehiculos = Vehiculo::orderBy('id','DESC')->paginate(20);
    return view('front/index',['vehiculos'=>$vehiculos]);
  }

  public function searchTipo($id){
    $tipo = Tipo::find($id);
    $vehiculos = $tipo->vehiculos()->paginate(20);
    return view('front/index',['vehiculos'=>$vehiculos]);
  }

  public function searchMarca($id){
    $marca = Marca::find($id);
    $marcas = $marca->vehiculos()->paginate(20);
    return view('front/index',['vehiculos'=>$marcas]);
  }

}
