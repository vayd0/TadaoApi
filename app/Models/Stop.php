<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    protected $table = "stops";
    protected $primaryKey = 'stop_id';
    public $incrementing = false;
    public $timestamps = false;
}