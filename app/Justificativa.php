<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificativa extends Model
{
    protected $fillable = ['observacao', 'status' => 'PENDENTE', 'tipo_justificativa_id', 'ocorrencia_id'];
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
}
