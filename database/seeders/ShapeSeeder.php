<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shape;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("/database/data/shapes.txt"), "r");
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            Shape::create([
                'shape_id' => $data[0],
                'shape_pt_lat' => $data[1],
                'shape_pt_lon' => $data[2],
                'shape_pt_sequence' => $data[3],
            ]);
        }

        fclose($csvFile);
    }
}
