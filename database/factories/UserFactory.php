<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    /*return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];*/

    $faker = FakerFactory::create('pt_BR');
    return [
        'login' => $faker->unique()->userName,
        //'senha' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        'password' => bcrypt('123456'),

        'matricula' => $faker->unique()->numberBetween(10010, 10999),
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cartao' => $faker->unique()->numberBetween(10010, 10999),
        //'remember_token' => Str::random(10),

        'area_id' => 1, //alterado o modelo...
        'tipo_usuario_id' => 1,
    ];
});
