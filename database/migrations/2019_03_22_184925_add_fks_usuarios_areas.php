<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFksUsuariosAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('areas', function (Blueprint $table) {
            //
            $table->foreign('gerente_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('areas', function (Blueprint $table) {
            //
            $table->dropForeign('areas_gerente_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign('users_area_id_foreign');
        });
    }
}
