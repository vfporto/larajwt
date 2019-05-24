<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();

        $this->call(TipoUsuarioSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JornadaSeeder::class);


        Model::reguard();
    }
}
