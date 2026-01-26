<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    protected $table = "routes";
    protected $primaryKey = 'route_id';
    public $timestamps = false;

    public function trips() {
        return $this->hasMany(Trip::class, "route_id", "route_id");
    }
}
