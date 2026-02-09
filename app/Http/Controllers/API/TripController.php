<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Stop;
use Illuminate\Http\Request;
class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Trip::all();
        return response()->json($routes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_headsign' => 'required|string',
            'route_id' => 'required|integer|exists:App\Models\Route,route_id',
            'direction_id' => 'required|boolean',
            'shape_id' => 'required|exists:App\Models\Shape,shape_id',
            'data' => 'required|array',
        ]);
        $trip = new Trip;

        $trip->route_id = $request->input("route_id");
        $trip->trip_headsign = $request->input("trip_headsign");
        $trip->direction_id = $request->input("direction_id");
        $trip->shape_id = $request->input("shape_id");
        $trip->save();
        $arrets = $request->input("data");

        $count = 1;

        foreach ($arrets as $stop) {
            $trip->stops()->attach($stop['stop_id'], [
                'arrival_time' => $stop['arrival_time'],
                'departure_time' => $stop['departure_time'],
                'stop_sequence' => $count++
            ]);
        }
        return response()->json($trip->load(['route', 'stops']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return response()->json($trip->load('circuit.shapes'));
    }

    /* Retourne le trajet demandé en paramètre tout en incluant la route */
    public function showTripWithRoutes(Trip $trip)
    {
        return response()->json($trip->route);
    }

    /* Retourne le trajet avec ses arrêts */
    public function showTripWithStops(Trip $trip)
    {
        return response()->json($trip->stops);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'trip_headsign' => 'required|string',
            'direction_id' => 'required|boolean',
            'shape_id' => 'required|exists:App\Models\Shape,shape_id',
            'data' => 'required|array',
        ]);

        $trip->trip_headsign = $request->input('trip_headsign');
        $trip->direction_id = $request->input('direction_id');
        $trip->shape_id = $request->input('shape_id');

        $trip->save();

        if ($request->has('data')) {

            $trip->stops()->detach();
            $arrets = $request->input('data');
            $count = 1;
            foreach ($arrets as $stop) {
                $trip->stops()->attach($stop['stop_id'], [
                    'arrival_time' => $stop['arrival_time'],
                    'departure_time' => $stop['departure_time'],
                    'stop_sequence' => $count++
                ]);
            }
        }

        return response()->json($trip->load(['route', 'stops']));
    }


    public function updateSchedule(Request $request, Trip $trip, Stop $stop)
    {
        $validated = $request->validate([
            'arrival_time' => 'required|date_format:H:i',
            'departure_time' => 'required|date_format:H:i',
        ]);

        $trip->stops()->updateExistingPivot($stop->stop_id, [
            'arrival_time' => $validated['arrival_time'],
            'departure_time' => $validated['departure_time'],
        ]);

        return response()->json($trip->load('stops'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        return $trip->delete();
    }
}
