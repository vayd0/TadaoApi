<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stop_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("trip_id");
            $table->foreign("trip_id")->references("trip_id")->on('trips');
            $table->unsignedBigInteger("stop_id");
            $table->foreign(columns: "stop_id")->references("stop_id")->on('stops');
            $table->time("arrival_time");
            $table->time("departure_time");
            $table->integer(column: "stop_sequence");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stop_times');
    }
};
