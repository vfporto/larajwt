<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroDiario extends Model
{

    protected $table = 'registros_diarios';

    protected $fillable = ['data'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'usuario_id'];
    protected $dates = ['data', 'created_at', 'updated_at','deleted_at'];



    function usuario() {
        return $this->belongsTo('App\Usuario');
    }

    function registros() {
        return $this->hasMany('App\Registro');
    }

    function ocorrencias() {
        return $this->hasMany('App\Ocorrencia');
    }

}
