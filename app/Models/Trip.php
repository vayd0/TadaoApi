<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use App\Models\Circuit;
use App\Models\Stop;

class Trip extends Model
{
    protected $primaryKey = "trip_id";
    public $timestamps = false;
    public function route()
    {
        return $this->belongsTo(Route::class, "route_id", "route_id");
    }

    public function circuit()
    {
        return $this->belongsTo(Circuit::class, "shape_id", "shape_id");
    }


    public function stops()
    {
        return $this->belongsToMany(Stop::class, "stop_times", "trip_id", "stop_id", "trip_id", "stop_id")
                    ->withPivot(['arrival_time', 'departure_time', 'stop_sequence'])
                    ->orderBy("stop_sequence");
    }
}