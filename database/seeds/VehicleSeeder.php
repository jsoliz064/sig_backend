<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            [
                'contact' => '7777777',
                'plate' => 'BOL123',
                'seats' => 25,
                'car_model_id' => 1,
                'bus_id' => 1,
            ],
            [
                'contact' => '7777777',
                'plate' => 'BOL124',
                'seats' => 25,
                'car_model_id' => 1,
                'bus_id' => 1,
            ],
            [
                'contact' => '7777777',
                'plate' => 'BOL125',
                'seats' => 25,
                'car_model_id' => 1,
                'bus_id' => 1,
            ],
        ]);
    }
}
