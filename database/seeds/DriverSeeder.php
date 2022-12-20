<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
            //-17.77963293954632, -63.173716753776105
            [
                'inDate' => Carbon::parse('2000-01-01'),
                'outDate' => Carbon::parse('2000-02-01'),
                'user_id' => 1,
                'vehicle_id' => 1,
                'currentLat' => '-17.77963293954632',
                'currentLong' => '-63.173716753776105'
            ],
            [
                'inDate' => Carbon::parse('2000-01-01'),
                'outDate' => Carbon::parse('2000-02-01'),
                'user_id' => 1,
                'vehicle_id' => 2,
                'currentLat' => '-17.779719778971042',
                'currentLong' => '-63.17413517836752'
            ],//-17.779719778971042, -63.17413517836752
            [
                'inDate' => Carbon::parse('2000-01-01'),
                'outDate' => Carbon::parse('2000-02-01'),
                'user_id' => 2,
                'vehicle_id' => 1,
                'currentLat' => '-17.787336129275822',
                'currentLong' => '-63.17928281632804'
            ]
        ]);//-17.787336129275822, -63.17928281632804
    }
}
