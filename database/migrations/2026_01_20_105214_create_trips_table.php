<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id('trip_id');
            $table->string('trip_headsign');
            $table->boolean('direction_id');
            $table->unsignedBigInteger('route_id');
            $table -> foreign("route_id") -> references("route_id") -> on('routes');
            $table->string('shape_id');
            $table -> foreign("shape_id") -> references("shape_id") -> on('circuits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
