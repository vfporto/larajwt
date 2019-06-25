<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroDiario extends Model
{

    protected $table = 'registros_diarios';

    protected $fillable = ['data'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'user_id'];
    protected $dates = ['data:Y-m-d', 'created_at', 'updated_at','deleted_at'];



    function user() {
        return $this->belongsTo('App\User');
    }

    function registros() {
        return $this->hasMany('App\Registro')->orderBy('horario');
    }

    function ocorrencias() {
        return $this->hasMany('App\Ocorrencia');
    }

}
