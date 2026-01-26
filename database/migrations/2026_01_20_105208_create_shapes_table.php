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
        Schema::create('shapes', function (Blueprint $table) {
            $table -> id();
            $table -> string("shape_id");
            $table -> foreign("shape_id") -> references("shape_id") -> on('circuits');
            $table -> double("shape_pt_lat");
            $table -> double("shape_pt_lon");
            $table -> integer("shape_pt_sequence");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shapes');
    }
};
