<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome',50);
            //$table->unsignedBigInteger('gerente_id')->nullable(); //alterado para tabela associativa

            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('area_funcionario', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('usuario_id');
            $table->boolean('is_gerente');

            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_funcionario');
        Schema::dropIfExists('areas');

    }
}
