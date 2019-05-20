<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoJustificativa extends Model
{
    protected $fillable = ['nome', 'codigo'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];
}
