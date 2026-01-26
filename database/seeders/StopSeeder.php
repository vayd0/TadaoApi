<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stop;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("/database/data/stops.txt"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }
            
            Stop::create([
                'stop_id' => $data[0],
                'stop_code' => $data[1],
                'stop_name' => $data[2],
                'stop_desc' => $data[3],
                'stop_lat' => $data[4],
                'stop_lon' => $data[5],
                //'zone_id' => $data[6],
                'stop_url' => $data[7],
            ]);
        }

        fclose($csvFile);
    }
}
