<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJustificativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificativas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacao', 500)->nullable();

            $table->unsignedBigInteger('ocorrencia_id');
            $table->foreign('ocorrencia_id')->references('id')->on('ocorrencias')->onDelete('restrict');

            $table->unsignedBigInteger('tipo_justificativa_id');
            $table->foreign('tipo_justificativa_id')->references('id')->on('tipo_justificativas')->onDelete('restrict');

            //Solução de curto prazo para aprovação de pendências
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            //----------------------------------------------------

            $table->enum('status',['PENDENTE', 'APROVADA', 'REPROVADA']);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justificativas');
    }
}
