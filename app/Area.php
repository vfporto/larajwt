<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['nome','gerente_id'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];


    function gerente() {
        return $this->belongsTo('App\User');
    }
    function funcionarios() {
        return $this->hasMany('App\User');
    }
}
