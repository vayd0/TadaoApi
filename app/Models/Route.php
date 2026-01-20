<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = "Routes";
    protected $primaryKey = 'route_id';
    public $timestamp = false;

    // TODO Relations Routes -> Trips
}
