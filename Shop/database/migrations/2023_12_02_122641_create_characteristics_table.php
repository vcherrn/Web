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

        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->text('right_hand')->nullable();
            $table->text('left_hand')->nullable();
            $table->text('right_leg')->nullable();
            $table->text('left_leg')->nullable();
            $table->decimal('weight', 8, 1)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->integer('age')->nullable();
            $table->text('description')->nullable();
            //$table->timestamp('created_at')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics');
    }
};
