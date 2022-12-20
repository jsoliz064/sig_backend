<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            [
                'id' => 1,
                'color' => 'red',
                'name' => 'lv01',
                'photo'=>"https://tucolectivo.info/img/colectivos/1m.webp"
            ],
            [
                'id' => 2,
                'color' => 'red',
                'name' => 'lv02',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg"
            ],
            [
                'id' => 5,
                'color' => 'red',
                'name' => 'lv05',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg"
            ],
            [
                'id' => 8,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv08'
            ],
            [
                'id' => 9,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv09'
            ],
            [
                'id' => 10,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv010'
            ],
            [
                'id' => 11,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv011'
            ],
            [
                'id' => 16,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv016'
            ],
            [
                'id' => 17,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv017'
            ],
            [
                'id' => 18,
                'color' => 'red',
                'photo'=>"https://live.staticflickr.com/7404/9145821669_2693fbb927_b.jpg",
                'name' => 'lv018'
            ],
        ]);
    }
}
