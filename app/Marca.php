<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Marca extends Model
{
  protected $table = 'marcas';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre'
  ];

  public function vehiculos(){
      return $this->hasMany('App\Vehiculo');
  }

  public function scopeSearch($query,$name){
    return $query->where('nombre','=',''.$name.'');
  }

  public function scopeTopMarcas(){
    return DB::table('marcas')
                        ->select(DB::raw('count(vehiculos.id) as num_vehiculos, sum(vehiculos.kilometraje) as suma_kilometraje, avg(vehiculos.kilometraje) as promedio, marcas.nombre, marcas.id'))
                        ->join('vehiculos', 'marcas.id', '=', 'vehiculos.marca_id')
                        ->groupBy('marcas.id')
                        ->orderBy('promedio','DESC')
                        ->take(10)
                        ->get();
  }

}
