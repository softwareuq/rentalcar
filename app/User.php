<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
  protected $table = 'users';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'cedula', 'name', 'licencia','telefono','direccion','tipo','horasAcumuladas','email'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
    protected $hidden = [
        'password'
    ];

    public function rentas(){
      return $this->hasMany('App\Renta');
    }

    public function admin(){
      return $this->tipo === 'administrador';
    }

    public function cliente(){
      return $this->tipo === 'cliente';
    }

    public function scopeSearchCedula($query,$cedula){
      return $query->where('cedula','=',$cedula);
    }

    public function scopeTopUsers(){
      return DB::table('users')
                          ->select(DB::raw('count(rentas.id) as num_rentas, users.name, users.cedula'))
                          ->join('rentas', 'users.id', '=', 'rentas.usuario_id')
                          ->groupBy('users.id')
                          ->orderBy('num_rentas','DESC')
                          ->take(10)
                          ->get();
    }
}
