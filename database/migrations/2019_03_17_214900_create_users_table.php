<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('name');
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('login', 20)->unique();
            //$table->string('password');
            //Campos de Funcionario
            $table->string('nome', 100);
            //$table->string('email', 50);
            $table->integer('matricula',false,true);
            $table->string('cartao',20);
            //--------
            $table->unsignedBigInteger('tipo_usuario_id');
            $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuarios')->onDelete('cascade');




            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}