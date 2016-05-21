<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Requests\UsuarioRequest;

class UsersController extends Controller
{
  public function index(){
    $usuarios = User::orderBy('id','ASC')->paginate(20);
    return view('management/usuarios/index',['usuarios'=>$usuarios]);
  }

  public function store(UsuarioRequest $request){
    $usuario = new User();
    $usuario->cedula=$request->cedula;
    $usuario->name=$request->name;
    $usuario->licencia=$request->cedula;
    $usuario->telefono=$request->telefono;
    $usuario->direccion=$request->direccion;
    $usuario->tipo=$request->tipo;
    $usuario->horasAcumuladas=0;
    $usuario->email=$request->email;
    $usuario->password=bcrypt($request->password);

    $usuario->save();

    Flash::success('Usuario '.$usuario->nombre.' registrado');
    return redirect()->route('management.users.index');
  }

  public function destroy($id){
    $usuario = User::find($id);
    $usuario->delete();

    Flash::warning('Usuario '.$usuario->name.' eliminado');
    return redirect()->route('management.users.index');
  }

  public function edit($id){
    $usuario = User::find($id);
    return view('management/usuarios/edit',['usuario'=>$usuario]);
  }

  public function update(Request $request,$id){
    $usuario = User::find($id);

    $usuarios = User::all();
    $flagCedula = false;
    $flagCorreo = false;

    foreach ($usuarios as $user) {
      if($user->cedula == $request->cedula && $user->id != $id){
        $flagCedula = true;
      }
      if($user->email == $request->email && $user->id != $id){
        $flagCorreo = true;
      }
    }

    if ($flagCedula == true) {
      Flash::warning('Ya existe un usuario registrado con esta cedula');
      return redirect()->route('management.users.edit',$id);
    }
    if ($flagCorreo == true) {
      Flash::warning('Ya existe un usuario registrado con este correo');
      return redirect()->route('management.users.edit',$id);
    }
    if ($flagCorreo == false && $flagCedula == false) {

      $usuario->cedula=$request->cedula;
      $usuario->name=$request->name;
      $usuario->licencia=$request->cedula;
      $usuario->telefono=$request->telefono;
      $usuario->direccion=$request->direccion;
      $usuario->tipo=$request->tipo;
      $usuario->horasAcumuladas=$usuario->horasAcumuladas;
      $usuario->email=$request->email;
      $usuario->password=bcrypt($request->password);

      $usuario->save();

      Flash::success('Usuario '.$usuario->name.' actualizado');
      return redirect()->route('management.users.index');
    }
  }

  public function topusers(){
    $users = User::topUsers();
    return response()->json($users);
  }
}
