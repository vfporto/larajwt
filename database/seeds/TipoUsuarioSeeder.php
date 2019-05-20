<?php

use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         App\TipoUsuario::create(['id' => 1, 'nome' => 'admin']);
         App\TipoUsuario::create(['id' => 2, 'nome' => 'gestor']);
         App\TipoUsuario::create(['id' => 3, 'nome' => 'gerente']);
         App\TipoUsuario::create(['id' => 4, 'nome' => 'funcionario']);
         */

        //App\TipoUsuario::create(['nome' => str_random(10)]);


         App\TipoUsuario::create(['nome' => 'funcionario']);
         App\TipoUsuario::create(['nome' => 'gerente']);
         App\TipoUsuario::create(['nome' => 'gestor']);



    }
}
