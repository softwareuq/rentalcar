<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $table = 'rentas';

    protected $fillable = [
        'fecha', 'kilometrajeActual', 'usuario_id','vehiculo_id'
    ];

    public function usuario(){
      return $this->belongsTo('App\User');
    }

    public function vehiculo(){
      return $this->belongsTo('App\Vehiculo');
    }

    public function devolucion(){
      return $this->hasOne('App\Devolucion');
    }

    public function scopeSearchUser($query,$id){
      return $query->where('usuario_id','=',$id);
    }

    public function scopeSearchVehiculo($query,$id){
      return $query->where('vehiculo_id','=',$id);
    }

    public function scopeSearchCod($query,$cod){
      return $query->where('id','=',$cod);
    }

    public function scopeSearchEstado($query,$estado){
      return $query->where('estado','=',''.$estado.'');
    }
}
