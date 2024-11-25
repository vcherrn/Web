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

        Schema::create('prosthes', function (Blueprint $table) {
            $table->id();
            $table->integer('specifiable_id');
            $table->string('specifiable_type', 50);
            $table->foreignId('category_id')->constrained();
            $table->foreignId('creator_id')->constrained();
            $table->boolean('status');
            $table->string('article', 40)->nullable();
            $table->string('name', 40)->nullable();
            $table->text('description')->nullable();
            $table->text('photos')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('year_of_creating')->nullable();
            
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prosthes');
    }
};
