<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shape;
class Circuit extends Model
{
    protected $table = "circuits";
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = false;
    public $primaryKey = 'shape_id';
    public function trips()
    {
        return $this->hasMany(Trip::class, "shape_id", "shape_id");
    }

    public function shapes()
    {
        return $this->hasMany(Shape::class, "shape_id", "shape_id")->orderBy("shape_pt_sequence");
    }
}
