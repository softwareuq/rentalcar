<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as' => 'front.index','uses' => 'FrontController@index']);
Route::get('/vehiculos/tipo/{id}',['as' => 'front.search.tipo','uses' => 'FrontController@searchTipo']);
Route::get('/vehiculos/marca/{id}',['as' => 'front.search.marca','uses' => 'FrontController@searchMarca']);


Route::group(['prefix'=>'management','middleware'=>'auth'],function(){

  Route::get('/', ['as' => 'management.index', function () {
      return view('management/index');
  }]);

  Route::group(['middleware'=>'administrador'],function(){

    Route::resource('marcas','MarcasController');
    Route::get('marca/{id}/destroy',['uses'=>'MarcasController@destroy',
                                    'as' => 'management.marcas.destroy']);
    Route::get('marca/topmarcas','MarcasController@kilometraje');

    Route::resource('tipos','TiposController');
    Route::get('tipo/{id}/destroy',['uses'=>'TiposController@destroy',
                                    'as' => 'management.tipos.destroy']);
    Route::get('tipo/toptipos','TiposController@kilometraje');

    Route::resource('devoluciones','DevolucionesController');
    Route::get('devolucion/{id}/create',['uses'=>'DevolucionesController@create',
                                    'as' => 'management.devoluciones.create']);
    Route::post('devolucion/{id}/store',['uses'=>'DevolucionesController@store',
                                    'as' => 'management.devoluciones.store']);
    Route::get('devolucion/{id}/facturar',['uses'=>'DevolucionesController@facturar',
                                    'as' => 'management.devoluciones.facturar']);
    Route::get('devolucion/{id}/imprimir',['uses'=>'DevolucionesController@imprimirFactura',
                                    'as' => 'management.devoluciones.imprimir']);
  });

  Route::resource('users','UsersController');
  Route::get('user/{id}/destroy',['uses'=>'UsersController@destroy',
                                  'as' => 'management.users.destroy']);
  Route::get('user/topusers','UsersController@topusers');

  Route::resource('vehiculos','VehiculosController');
  Route::get('vehiculo/{id}/destroy',['uses'=>'VehiculosController@destroy',
                                  'as' => 'management.vehiculos.destroy']);
  Route::get('vehiculo/reporte',['uses'=>'VehiculosController@reporte',
                                  'as' => 'management.vehiculos.reporte']);
  Route::get('vehiculo/{id}/getvehiculo',['uses'=>'VehiculosController@getVehiculo',
                                  'as' => 'management.vehiculos.getvehiculo']);
  Route::get('vehiculo/topkilometraje','VehiculosController@kilometraje');
  Route::get('vehiculo/allvehicles','VehiculosController@allvehicles');
  Route::get('vehiculo/topvehiculos','VehiculosController@topvehiculos');

  Route::resource('rentas','RentasController');
  Route::get('renta/{id}/destroy',['uses'=>'RentasController@destroy',
                                  'as' => 'management.rentas.destroy']);
  Route::get('renta/{id}/store',['uses'=>'RentasController@store',
                                  'as' => 'management.rentas.store']);
  Route::get('renta/{id}/entrega',['uses'=>'RentasController@entrega',
                                  'as' => 'management.rentas.entrega']);
  Route::get('renta/{id}/liberar',['uses'=>'RentasController@liberar',
                                  'as' => 'management.rentas.liberar']);
  Route::get('renta/reporte',['uses'=>'RentasController@reporte',
                                  'as' => 'management.rentas.reporte']);
  Route::get('renta/getrentas','RentasController@getRentas');



});
//Rutas de registro y autenticacion
Route::get('management/auth/register',['uses'=>'FrontController@createClient',
                                'as' =>'management.auth.create']);
Route::post('management/auth/store',['uses'=>'FrontController@storeClient',
                                'as' =>'management.auth.store']);

Route::get('management/auth/login',['uses'=>'Auth\AuthController@getLogin',
                                'as' =>'management.auth.login']);

Route::post('management/auth/login',['uses'=>'Auth\AuthController@postLogin',
                              'as' =>'management.auth.login']);

Route::get('management/auth/logout',['uses'=>'Auth\AuthController@logout',
                                'as' =>'management.auth.logout']);
