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
        Schema::disableForeignKeyConstraints();

        Schema::create('specification_knees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('product_type', 100)->nullable();
            $table->string('amputation_rate', 100)->nullable();
            $table->string('activity_level', 20)->nullable();
            $table->integer('max_weight')->nullable();
            $table->integer('weight')->nullable();
            $table->string('material', 60)->nullable();
            $table->string('distal_part_connection', 50)->nullable();
            $table->string('proximal_part_connection', 50)->nullable();
            $table->integer('knee_angle')->nullable();
            $table->string('system_height_prox', 50)->nullable();
            $table->string('min_system_height_dist', 50)->nullable();
            $table->string('max_system_height_dist', 50)->nullable();
            $table->string('min_montage_height', 50)->nullable();
            $table->string('max_montage_height', 50)->nullable();
            $table->string('proximal_montage_height', 50)->nullable();
            $table->string('min_dist_montage_height', 50)->nullable();
            $table->string('max_dist_montage_height', 50)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specification_knees');
    }
};
