<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    //$table->bigIncrements('id');
    //$table->timestamp('horario');
    //
    // $table->unsignedBigInteger('user_id');
    // $table->foreign('user_id')
    // ->references('id')
    // ->on('users')
    // ->onDelete('cascade');

    //use SoftDeletes;

    protected $fillable = ['horario'/*, 'registro_diario_id'*/];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'user_id'];
    protected $dates = [/*'horario', */'created_at', 'updated_at','deleted_at'];

    /* //--alteração nas associações
    function user() {
        return $this->belongsTo('App\User');
    }*/

    function registroDiario(){
        return $this->belongsTo('App\RegistroDiario');
    }
}
