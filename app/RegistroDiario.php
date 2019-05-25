<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroDiario extends Model
{
protected $fillable = ['dia'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'usuario_id'];
    protected $dates = ['dia', 'created_at', 'updated_at','deleted_at'];



    function usuario() {
        return $this->belongsTo('App\Usuario');
    }
}
