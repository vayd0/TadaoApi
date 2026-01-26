<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("/database/data/trips.txt"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }
            Trip::create([
                'route_id' => $data[0],
                'trip_id' => $data[2],
                'trip_headsign' => $data[3],
                'direction_id' => $data[4],
                'shape_id' => $data[6],
            ]);
        }

        fclose($csvFile);
    }
}
