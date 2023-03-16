<?php

use Illuminate\Database\Seeder;

use App\WorkDay;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<7; ++$i){
            WorkDay::create([
                'day' => $i,
                'active'=> ($i==3), //Thursday

                'morning_start' => ($i==3  ? '08:00:00' : '08:00:00'),
                'morning_end'=> ($i==3  ? '11:00:00' : '08:00:00'),

                'afternoon_start'=> ($i==3  ? '13:00:00' : '13:00:00'),
                'afternoon_end'=> ($i==3  ? '23:00:00' : '13:00:00'),

                'user_id' => 3 // Cancha1 (UserTableSeeder)
            ]);
        }
    }
}
