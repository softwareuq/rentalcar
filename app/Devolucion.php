<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
  protected $table = 'devoluciones';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'fecha', 'kilometrajeActual', 'estadoVehiculo','observaciones','renta_id'
  ];

  public function renta(){
    return $this->belongsTo('App\Renta');
  }

}
