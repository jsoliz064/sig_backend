<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('license_categories')->insert([
            [
                'license' => 'A',
            ],
            [
                'license' => 'B',
            ],
            [
                'license' => 'C',
            ],
            [
                'license' => 'P',
            ],
            [
                'license' => 'S',
            ],
        ]);
    }
}
