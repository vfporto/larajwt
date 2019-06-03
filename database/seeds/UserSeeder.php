<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User as User;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() { /*
        App\User::create([
            'name' => 'Fabricio',
            'email' => 'vfporto@vfporto',
            'password' => Hash::make('123456'), //bcrypt('123456'),
        ]);

        App\User::create([
            'name' => 'funcionario',
            'email' => 'funcionario',
            'password' => Hash::make('123456'), //bcrypt('123456'),
        ]);

        App\User::create([
            'name' => 'gerente',
            'email' => 'gerente',
            'password' => Hash::make('123456'), //bcrypt('123456'),
        ]);

        App\User::create([
            'name' => 'gestor',
            'email' => 'gestor',
            'password' => Hash::make('123456'), //bcrypt('123456'),
        ]);

*/


        App\User::create([
            'login' => 'vfporto',
            'password' => bcrypt('123456'),

            'matricula' => 10000,
            'nome' => 'Fabricio',
            'email' => 'vfporto@vfporto',
            'cartao' => '10000',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 1,
        ]);
        App\User::create([
            'login' => 'jefferson',
            'password' => bcrypt('123456'),

            'matricula' => 10001,
            'nome' => 'Jefferson',
            'email' => 'jefferson@jefferson',
            'cartao' => '10001',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 1,
        ]);

        App\User::create([
            'login' => 'fernando',
            'password' => bcrypt('123456'),

            'matricula' => 10002,
            'nome' => 'Fernando',
            'email' => 'fernando@fernando',
            'cartao' => '10002',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 1,
        ]);

        App\User::create([
            'login' => 'funcionario',
            'password' => bcrypt('123456'),

            'matricula' => 10005,
            'nome' => 'funcionario',
            'email' => 'funcionario',
            'cartao' => '10005',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 1,
        ]);

        App\User::create([
            'login' => 'gerente',
            'password' => bcrypt('123456'),

            'matricula' => 10006,
            'nome' => 'gerente',
            'email' => 'gerente',
            'cartao' => '10006',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 2,
        ]);

        App\User::create([
            'login' => 'gestor',
            'password' => bcrypt('123456'),

            'matricula' => 10007,
            'nome' => 'gestor',
            'email' => 'gestor',
            'cartao' => '10007',
            /*'area_id' => 1,*/
            'tipo_usuario_id' => 3,
        ]);
        factory(App\User::class, 10)->create();

        $lista = User::all();
        foreach ($lista as $user) {
            $user->jornadas()->attach(1);
            $user->jornadas()->attach(2);
        }
    }
}
