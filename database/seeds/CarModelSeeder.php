<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_models')->insert([
            [
                'model' => 'Citaro CIJB',
            ],
            [
                'model' => '8-150FEB',
            ],
            [
                'model' => '8-123CIJB',
            ]
        ]);
    }
}
