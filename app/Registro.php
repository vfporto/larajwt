<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    //$table->bigIncrements('id');
    //$table->timestamp('horario');
    //
    // $table->unsignedBigInteger('usuario_id');
    // $table->foreign('usuario_id')
    // ->references('id')
    // ->on('usuarios')
    // ->onDelete('cascade');

    //use SoftDeletes;

    protected $fillable = ['horario'/*, 'registro_diario_id'*/];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'usuario_id'];
    protected $dates = [/*'horario', */'created_at', 'updated_at','deleted_at'];

    /* //--alteração nas associações
    function usuario() {
        return $this->belongsTo('App\Usuario');
    }*/

    function registroDiario(){
        return $this->belongsTo('App\RegistroDiario');
    }
}
