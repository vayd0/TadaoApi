<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CircuitSeeder::class,
            RouteSeeder::class,
            ShapeSeeder::class,
            StopSeeder::class,
            TripSeeder::class,
            StopTimesSeeder::class,
        ]);
    }
}
