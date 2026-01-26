<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Route;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("/database/data/routes.txt"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }
            Route::create([
                'route_id' => $data[0],
                'route_short_name' => $data[1],
                'route_long_name' => $data[2],
                'route_color' => $data[6],
                'route_text_color' => $data[7]
            ]);
        }

        fclose($csvFile);
    }
}
