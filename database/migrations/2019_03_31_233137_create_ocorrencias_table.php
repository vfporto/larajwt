<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('descricao', 200);

            $table->unsignedBigInteger('registro_diario_id');
            $table->foreign('registro_diario_id')->references('id')->on('registros_diarios')->onDelete('restrict');

            $table->unsignedBigInteger('tipo_ocorrencia_id');
            $table->foreign('tipo_ocorrencia_id')->references('id')->on('tipo_ocorrencias')->onDelete('restrict');

            /*$table->unsignedBigInteger('status_ocorrencia_id');
            $table->foreign('status_ocorrencia_id')->references('id')->on('status_ocorrencias')->onDelete('restrict');*/

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
        Schema::dropIfExists('ocorrencias');
    }
}
