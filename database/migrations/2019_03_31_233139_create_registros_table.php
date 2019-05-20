<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('horario');

            //$table->unsignedBigInteger('usuario_id');
            //$table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

            $table->unsignedBigInteger('registro_diario_id');
            $table->foreign('registro_diario_id')->references('id')->on('registros_diarios')->onDelete('restrict');

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
        Schema::dropIfExists('registros');
    }
}
