<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome'];

    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    protected $dates = ['deleted_at'];

    function users() {
        return $this->hasMany('App\TipoUsuario');
        //return $this->belongsTo('App\User');
    }
}
