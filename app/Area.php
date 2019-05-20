<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['nome'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];


    function gerente() {
        return $this->belongsTo('App\Usuario');
    }
    function funcionarios() {
        return $this->hasMany('App\Usuario');
    }
}
