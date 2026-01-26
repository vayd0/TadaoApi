<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\hasMany;
class Shape extends Model
{
    protected $table = "shapes";
    public $timestamps = false;
}
