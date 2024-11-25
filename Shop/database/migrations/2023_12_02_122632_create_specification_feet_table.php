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

        Schema::create('specification_foots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('product_type', 100)->nullable();
            $table->string('amputation_rate', 100)->nullable();
            $table->string('activity_level', 20)->nullable();
            $table->integer('max_weight')->nullable();
            $table->string('type_of_side', 10)->nullable();
            $table->string('size_of_prosthes', 20)->nullable();
            $table->integer('weight')->nullable();
            $table->string('foot_shape', 200)->nullable();
            $table->string('color', 60)->nullable();
            $table->integer('height')->nullable();
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
        Schema::dropIfExists('specification_feet');
    }
};
