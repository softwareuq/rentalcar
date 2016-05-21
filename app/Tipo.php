<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Tipo extends Model
{
  protected $table = 'tipos';
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

  public function scopeTopTipos(){
    return DB::table('tipos')
                        ->select(DB::raw('count(vehiculos.id) as num_vehiculos, sum(vehiculos.kilometraje) as suma_kilometraje, avg(vehiculos.kilometraje) as promedio, tipos.nombre, tipos.id'))
                        ->join('vehiculos', 'tipos.id', '=', 'vehiculos.tipo_id')
                        ->groupBy('tipos.id')
                        ->orderBy('promedio','DESC')
                        ->take(10)
                        ->get();
  }

}
