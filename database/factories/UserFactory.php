<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC',// password
        'remember_token' => str::random(6),
        'phone' =>$faker->e164PhoneNumber,
        'role' =>$faker->randomElement(['clientes','empleado'])
    ];
});

$factory->state(App\User::class, 'clientes',[
    'role' => 'clientes'
]);

$factory->state(App\User::class, 'empleado',[
    'role' => 'empleado'
]);