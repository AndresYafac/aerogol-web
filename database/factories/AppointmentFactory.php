<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Appointment;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Appointment::class, function (Faker $faker) {
    $courtIds = User::empleado()->pluck('id');
    $clienteIds = User::clientes()->pluck('id');

    $date = $faker->dateTimeBetween('-1 years','now');
    $schedule_date = $date->format('Y-m-d');
    $schedule_time = $date->format('H:i:s'); 

    $types = ['Yape','Plin','Efectivo'];
    $statuses = ['Atendida','Cancelada']; //'Reservada','Confirmada'

    return [
        'description' => $faker->sentence(5),
        'deporte_id' => $faker->numberBetween(1,3),
        'court_id' => $faker->randomElement($courtIds),
        'cliente_id' => $faker->randomElement($clienteIds),
        'schedule_date' => $schedule_date,
        'schedule_time' => $schedule_time,
        'type' => $faker->randomElement($types),
        'status' => $faker->randomElement($statuses)
    ];
});
