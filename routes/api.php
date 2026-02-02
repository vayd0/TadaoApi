<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;
use App\Http\Controllers\API\TripController;
use App\Http\Controllers\API\StopController;

Route::apiResource("routes", controller: RouteController::class);
Route::apiResource("trips", controller: TripController::class);
Route::apiResource("stops", controller: StopController::class);

Route::get('/routes/{route}/trips', [RouteController::class, "showTrips"]);
Route::get('/routes/{route}/stops', [RouteController::class, "showStops"]);

Route::get('/trips/{trip}/routes', [TripController::class, "showTripWithRoutes"]);
Route::get('/trips/{trip}/stops', action: [TripController::class, "showTripWithStops"]);

Route::get('/stops/{stop}/routes', [StopController::class, "showRouteForStop"]);
Route::get('/stops/{stop}/routes/{route}', [StopController::class, "showScheduleForRouteAndStop"]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');