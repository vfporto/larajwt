<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $fillable = ['nome', 'data'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['data','created_at', 'updated_at','deleted_at'];
}
