<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    protected $fillable = ['descricao', 'tipo_ocorrencia_id', 'registro_diario_id'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];

    public function tipoOcorrencia()
    {
        return $this->belongsTo('App\TipoOcorrencia','tipo_ocorrencia_id');
        //return $this->belongsToMany('App\User', 'jornadas_users', 'jornada_id', 'user_id');
    }

    public function registroDiario() {
        return $this->belongsTo('App\RegistroDiario','registro_diario_id');
    }

}
