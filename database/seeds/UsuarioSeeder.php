<?php

use Illuminate\Database\Seeder;
use App\Usuario;

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
            'password' => bcrypt('123456'),

            'matricula' => 10000,
            'nome' => 'Fabricio',
            'email' => 'vfporto@vfporto',
            'cartao' => '10000',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 1,
        ]);

        App\Usuario::create([
            'login' => 'funcionario',
            'password' => bcrypt('123456'),

            'matricula' => 10001,
            'nome' => 'funcionario',
            'email' => 'funcionario',
            'cartao' => '10001',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 1,
        ]);

        App\Usuario::create([
            'login' => 'gerente',
            'password' => bcrypt('123456'),

            'matricula' => 10002,
            'nome' => 'gerente',
            'email' => 'gerente',
            'cartao' => '10002',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 2,
        ]);

        App\Usuario::create([
            'login' => 'gestor',
            'password' => bcrypt('123456'),

            'matricula' => 10003,
            'nome' => 'gestor',
            'email' => 'gestor',
            'cartao' => '10003',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 3,
        ]);
        factory(App\Usuario::class, 10)->create();

        $lista = Usuario::all();
        foreach ($lista as $user) {
            $user->jornadas()->attach(1);
            $user->jornadas()->attach(2);
        }
    }
}
