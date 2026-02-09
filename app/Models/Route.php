<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    protected $table = "routes";
    protected $primaryKey = 'route_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'route_id',
        'route_short_name',
        'route_long_name',
        'route_color',
        'route_text_color'
    ];

    public function trips() {
        return $this->hasMany(Trip::class, "route_id", "route_id");
    }
}
