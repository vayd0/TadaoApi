<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Models\Trip;

class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Stop::all();
        return response()->json($routes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stop_id' => 'required|string|unique:App\Models\Stop,stop_id',
            'stop_name' => 'required|string|max:255',
            'stop_desc' => 'required|string|max:255',
            'stop_lat' => 'required|numeric',
            'stop_lon' => 'required|numeric'
        ]);

        $validated['stop_code'] = $validated['stop_id'];
        $stop = Stop::create($validated);

        return response()->json($stop, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stop $stop)
    {
        return response()->json($stop);
    }

    /* Retourne les lignes de bus desservant l'arrêt */
    public function showRouteForStop(Stop $stop)
    {
        $res = response()->json(data: $stop->trips->unique("route_id")->pluck("route_id"));
        return response()->json(Route::whereIn('route_id', $res->original)->get());
    }

    /* Retourne les horaires pour un arrêt et une ligne de bus donnés. */
    public function showScheduleForRouteAndStop(Stop $stop, Route $route)
    {
        return response()->json($stop->trips()->where('route_id', $route->route_id)->select(['trips.trip_id', 'stop_times.departure_time'])->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stop $stop)
    {
        $validated = $request->validate([
            'stop_name' => 'required|string|max:255',
            'stop_desc' => 'required|string|max:255',
            'stop_lat' => 'required|numeric',
            'stop_lon' => 'required|numeric'
        ]);

        $stop->update($validated);
        $stop->save();

        return response()->json($stop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stop $stop)
    {
        $tripsIds = $stop->trips->pluck('trip_id');

        $stop->trips()->detach();
        foreach ($tripsIds as $trip_id) {
            $trip = Trip::find($trip_id);
            $stops = $trip->stops;

            for ($cpt = count($stops) - 1; $cpt >= 0; $cpt--) {
                $monStop = $stops[$cpt];
                if ($monStop->pivot->stop_sequence != $cpt) {
                    $monStop->pivot->stop_sequence = $cpt;
                    $monStop->pivot->save();
                } else {
                    break;
                }
            }
        }

        $stop->delete();
        return response()->noContent();
    }
}
