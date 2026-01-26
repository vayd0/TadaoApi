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
        Schema::create('stops', function (Blueprint $table) {
            $table->string('stop_id',8)->primary();
            $table->string('stop_code',8);
            $table->string('stop_name');
            $table->longText('stop_desc');
            $table->double('stop_lat');
            $table->double('stop_lon');
            //$table->float('zone_id');
            $table->string('stop_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops');
    }
};
