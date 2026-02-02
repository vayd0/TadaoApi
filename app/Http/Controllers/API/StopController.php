<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Route;
use Illuminate\Http\Request;

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
        //
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
        return response()->json($stop->trips()->where('route_id', $route->route_id)->select(['trips.trip_id','stop_times.departure_time'])->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stop $stop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stop $stop)
    {
        //
    }
}
