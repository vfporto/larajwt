<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusJustificativa extends Model
{
    protected $fillable = ['nome', 'codigo', 'descricao'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];

}
