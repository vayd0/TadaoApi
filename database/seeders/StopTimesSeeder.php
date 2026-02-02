<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;
class StopTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("/database/data/stop_times.txt"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $trip = Trip::find($data[0]);
            $trip->stops()->attach($data[3], [
                'arrival_time' => $data[1],
                'departure_time' => $data[2],
                'stop_sequence' => $data[4]
            ]);
        }

        fclose($csvFile);
    }
}
