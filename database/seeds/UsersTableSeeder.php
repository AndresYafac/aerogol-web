<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        User::create([
        'name' => 'Andres Yafac',
        'email' => 'andres.yafac.g@gmail.com',
        'password' => bcrypt('12345678'),      
        'phone' => '',
        'role' =>'admin'
        ]);

        //2
        User::create([
        'name' => 'Cliente1',
        'email' => 'Cliente1@gmail.com',
        'password' => bcrypt('12345678'),      
        'phone' => '',
        'role' =>'clientes'
        ]);

        //3
        User::create([
        'name' => 'Cancha1',
        'email' => 'Cancha1@gmail.com',
        'password' => bcrypt('12345678'),      
        'phone' => '',
        'role' =>'empleado'
        ]);

        factory(User::class, 50)->states('clientes')->create();     
    }
}
