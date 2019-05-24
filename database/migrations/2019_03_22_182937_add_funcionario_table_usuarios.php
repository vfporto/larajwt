<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFuncionarioTableUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //
            $table->string('nome', 100)->after('tipo_usuario_id');
            $table->string('email', 50)->after('nome');
            $table->string('cartao',20)->after('email');
            $table->integer('matricula',false,true)->after('email');

            //$table->unsignedBigInteger('area_id')->after('email'); //alterado esquema. agora com tabela associativa..
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //
            $table->dropColumn(['matricula', 'nome', 'email']);
        });
    }
}
