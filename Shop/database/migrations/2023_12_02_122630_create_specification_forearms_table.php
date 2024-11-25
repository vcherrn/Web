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

        Schema::create('specification_forearms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('product_type', 100)->nullable();
            $table->string('type_of_side', 10)->nullable();
            $table->integer('max_fingers_load')->nullable();
            $table->decimal('max_weight', 8, 2)->nullable();
            $table->integer('working_time')->nullable();
            $table->string('functions', 100)->nullable();
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
        Schema::dropIfExists('specification_forearms');
    }
};
