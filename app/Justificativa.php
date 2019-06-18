<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificativa extends Model
{
    protected $fillable = [
        'observacao',
        'status' => 'PENDENTE',
        'tipo_justificativa_id',
        'ocorrencia_id',
        'user_id',
        'area_id',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function tipoJustificativa()
    {
        return $this->belongsTo('App\TipoJustificativa');
    }

    public function ocorrencia()
    {
        return $this->belongsTo('App\Ocorrencia');
    }

    //--- Solução rápida para consulta de pendências gerenciais
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }

}
