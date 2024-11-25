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

        Schema::create('specification_hips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('product_type', 100)->nullable();
            $table->string('activity_level', 20)->nullable();
            $table->integer('max_weight')->nullable();
            $table->integer('weight')->nullable();
            $table->string('distal_part_connection', 50)->nullable();
            $table->string('proximal_part_connection', 50)->nullable();
            $table->integer('t_angle')->nullable();
            $table->integer('system_height')->nullable();
            $table->integer('montage_height')->nullable();
            $table->string('type_of_side', 10)->nullable();
            $table->string('material', 60)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specification_hips');
    }
};
