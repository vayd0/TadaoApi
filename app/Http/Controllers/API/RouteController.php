<?php

namespace App\Http\Controllers\API;

use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;
use App\Models\Stop;

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
        $validated = $request->validate([
            'route_short_name' => 'required|string|max:255|unique:App\Models\Route,route_short_name',
            'route_long_name' => 'required|string|max:255',
            'route_color' => 'required|hex_color|max:7',
            'route_text_color' => 'required|hex_color|max:7'
        ]);
        
        $route = Route::create([
            'route_id' => (int) $validated['route_short_name'],
            'route_short_name' => $validated['route_short_name'],
            'route_long_name' => $validated['route_long_name'],
            'route_color' => substr($validated['route_color'], 1),
            'route_text_color' => substr($validated['route_text_color'], 1)
        ]);

        return response()->json($route, 201);
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

        $stops = Stop::whereHas("trips", function (Builder $query) use ($tripsIds) {
            $query->whereIn('trips.trip_id', $tripsIds);
        })->get();
        return response()->json($stops);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'route_long_name' => 'required|string|max:255',
            'route_color' => 'required|hex_color|max:7',
            'route_text_color' => 'required|hex_color|max:7'
        ]);

        $validated['route_color'] = substr($validated['route_color'], 1);

        $validated['route_text_color'] = substr($validated['route_text_color'], 1);

        $route->update($validated);
        $route->save();

        return response()->json($route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $trips = $route->trips;
        foreach ($trips as $trip) {
            $trip->stops()->detach();
            $trip->delete();
        }
        $route->delete();

        return response()->noContent();
    }
}
