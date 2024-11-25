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

        Schema::create('specification_shoulders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('product_type', 100)->nullable();
            $table->string('type_of_side', 10)->nullable();
            $table->integer('gripping_power')->nullable();
            $table->integer('opening_width')->nullable();
            $table->decimal('voltage', 8, 2)->nullable();
            $table->decimal('gripping_speed', 8, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specification_shoulders');
    }
};
