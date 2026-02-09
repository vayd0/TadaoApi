<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Shape;
use Illuminate\Http\Request;

class ShapeController extends Controller
{
    /* Crée un nouveau circuit avec les shapes associés */
    public function store(Request $request) {
        $validated = $request->validate([
            'shape_id' => 'required|string|unique:App\Models\Circuit, shape_id|max:255',
            'data' => 'required|array',
        ]);

        Circuit::create([
            'shape_id' => $validated['shape_id']
        ]);

        $data = $validated['data'];
        $count = 1;

        foreach ($data as $item) {
            $values = [
                "shape_pt_lat" => $item[0],
                "shape_pt_lon" => $item[1],
                "shape_pt_sequence" => $count,
                "shape_id" => $validated['shape_id']
            ];
            Shape::create($values);
            $count++;
        }
        $circuit = Circuit::find($request->input('shape_id'));
        return response()->json($circuit, 201);
    }
}
