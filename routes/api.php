<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;
use App\Http\Controllers\API\TripController;
use App\Http\Controllers\API\StopController;
use App\Http\Controllers\ShapeController;

Route::apiResource("routes", controller: RouteController::class);
Route::apiResource("trips", controller: TripController::class);
Route::apiResource("stops", controller: StopController::class);

Route::get('/routes/{route}/trips', [RouteController::class, "showTrips"]);
Route::get('/routes/{route}/stops', [RouteController::class, "showStops"]);

Route::post('/shapes/createPath', [ShapeController::class, "store"]);

Route::get('/trips/{trip}/routes', [TripController::class, "showTripWithRoutes"]);
Route::get('/trips/{trip}/stops', action: [TripController::class, "showTripWithStops"]);
Route::put('/trips/{trip}/stop/shapes/{stop}', [TripController::class, "updateSchedule"]);

Route::get('/stops/{stop}/routes', [StopController::class, "showRouteForStop"]);
Route::get('/stops/{stop}/routes/{route}', [StopController::class, "showScheduleForRouteAndStop"]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');