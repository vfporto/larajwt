<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $fillable = ['nome', 'entrada', 'saida'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];


    public function funcionarios()
    {
        return $this->belongsToMany('App\User', 'jornadas_users', 'jornada_id', 'user_id');
    }

}
