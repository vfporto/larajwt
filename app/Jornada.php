<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $fillable = ['nome', 'entrada', 'saida'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['entrada', 'saida','created_at', 'updated_at','deleted_at'];


    public function funcionarios()
    {
        return $this->belongsToMany('App\Usuario', 'jornadas_usuarios', 'jornada_id', 'usuario_id');
    }

}
