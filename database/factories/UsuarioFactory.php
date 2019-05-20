<?php

use Faker\Generator as FFaker;

$factory->define(App\Usuario::class, function (FFaker $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'login' => $faker->userName,
        //'senha' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        'password' => bcrypt('senha'),

        'matricula' => $faker->unique()->numberBetween(10000, 10999),
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => Str::random(10),

        //'area_id' => 1, //alterado o modelo...
        'tipo_usuario_id' => 1,
    ];
});
