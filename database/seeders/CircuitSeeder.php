<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Circuit;

class CircuitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("/database/data/shapes.txt"), "r");
        $firstLine = true;

        $seen = [];

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            if (!in_array($data[0], $seen)) {
                Circuit::create([
                    'shape_id' => $data[0]
                ]);
                array_push($seen, $data[0]);
            }
        }

        fclose($csvFile);
    }
}
