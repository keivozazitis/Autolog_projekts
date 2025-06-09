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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->decimal('price', 10, 2);
            $table->string('body_type')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->integer('engine_volume')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('color')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('vin')->nullable();
            $table->date('next_inspection')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('prev_inspection_rating')->nullable();
            $table->string('prev_inspection_problem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
