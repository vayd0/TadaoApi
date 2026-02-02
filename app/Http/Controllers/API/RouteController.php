<?php

namespace App\Http\Controllers\API;

use App\Models\Stop;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::all();
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
    public function show(Route $route)
    {
        return response()->json($route);
    }

    /* Retourne la route demandé en paramètre tout en incluant le trip */
    public function showTrips(Route $route)
    {
        return response()->json($route->trips);
    }

    public function showStops(Route $route)
    {
        $tripsIds = $route->trips->pluck('trip_id');

        $stops = Stop::whereHas("trips", function (Builder $query) use($tripsIds) {
            $query->whereIn('trip_id', $tripsIds);
        })->get();
        return response()->json($stops);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
