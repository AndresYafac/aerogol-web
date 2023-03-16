<?php

use Illuminate\Database\Seeder;

use App\Deporte;
use App\User;

class DeportesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deportes = [
            'Fútbol',
            'Voley',
            'Basquet'
        ];
        foreach ($deportes as $deporteName) {
            $deporte = Deporte::create([
                'name' => $deporteName
            ]);           
            $deporte->users()->saveMany(
                factory(User::class, 3)->states('empleado')->make()  
            );
        }

        //Cancha1
        User::find(3)->deportes()->save($deporte);
    }
}
