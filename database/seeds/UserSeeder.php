<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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


    }
}
