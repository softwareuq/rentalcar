<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Vehiculo extends Model
{
  protected $table = 'vehiculos';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'placa', 'nombreFoto', 'precioAlquiler','capacidad','modelo','disponible','color','kilometraje','marca_id','tipo_id'
  ];

  public function marca(){
    return $this->belongsTo('App\Marca');
  }

  public function tipo(){
    return $this->belongsTo('App\Tipo');
  }

  public function scopeSearchMarca($query,$id){
    return $query->where('marca_id','=',$id);
  }

  public function scopeSearchTipo($query,$id){
    return $query->where('tipo_id','=',$id);
  }

  public function scopeSearchColor($query,$color){
    return $query->where('color','LIKE',''.$color.'');
  }

  public function scopeSearchModelo($query,$modelo){
    return $query->where('modelo','=',$modelo);
  }

  public function scopeSearchPrecio($query,$precio){
    return $query->where('precioAlquiler','<=',$precio);
  }

  public function scopeSearchCapacidad($query,$capacidad){
    return $query->where('capacidad','=',$capacidad);
  }

  public function scopeSearchDisponibilidad($query,$disponible){
    return $query->where('disponible','=',$disponible);
  }

  public function scopeSearchPlaca($query,$placa){
    return $query->where('placa','=',''.$placa.'');
  }

  public function scopeSearchId($query,$id){
    return $query->where('id','=',$id);
  }

  public function scopeTopVehiculos(){
    return DB::table('vehiculos')
                        ->select(DB::raw('count(rentas.id) as num_rentas, vehiculos.placa'))
                        ->join('rentas', 'vehiculos.id', '=', 'rentas.vehiculo_id')
                        ->groupBy('vehiculos.id')
                        ->orderBy('num_rentas','DESC')
                        ->take(10)
                        ->get();
  }

}
