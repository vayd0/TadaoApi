<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trip;
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
        //
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        return $trip->delete();
    }
}
