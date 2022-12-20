<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LicenseCategorySeeder::class);
        $this->call(BusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CoordinateSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(DriverSeeder::class);
    }
}
