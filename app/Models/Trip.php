<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Trip extends Model
{
    protected $primaryKey = "trip_id";
    public $timestamps = false;
    public function route()
    {
        return $this->BelongsTo(Route::class, "route_id", "route_id");
    }

    public function circuit()
    {
        return $this->BelongsTo(Circuit::class, "shape_id", "shape_id");
    }
}