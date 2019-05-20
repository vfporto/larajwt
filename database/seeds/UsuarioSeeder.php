<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*App\Usuario::create([
            'login' => str_random(10),
            'senha' => bcrypt('secret'),
            'tipo_usuario_id' => 1
       ]);*/
       App\Usuario::create([
        'login' => 'vfporto',
        'password' => bcrypt('senha'),

        'matricula' => 10000,
        'nome' => 'Fabricio',
        'email' => 'vfporto@vfporto',
        /*'area_id' => 1,*/
        'tipo_usuario_id' => 1,
        ]);
       factory(App\Usuario::class, 10)->create();
    }
}
