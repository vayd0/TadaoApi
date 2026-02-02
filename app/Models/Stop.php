<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\belongsToMany;

class Stop extends Model
{
    protected $table = "stops";
    protected $primaryKey = 'stop_id';
    public $incrementing = false;
    public $timestamps = false;
    public function trips()
    {
        return $this->belongsToMany(Trip::class, "stop_times", "stop_id", "trip_id", "stop_id", "trip_id")
                    ->withPivot(['arrival_time', 'departure_time', 'stop_sequence']);
    }
}