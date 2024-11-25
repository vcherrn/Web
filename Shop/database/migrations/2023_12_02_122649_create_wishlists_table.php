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

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prosthes_id')->constrained('prosthes');
            $table->foreignId('user_id')->constrained();
           // $table->timestamp('created_at')->nullable();
            //$table->timestamp('updated_at')->nullable();
           // $table->foreignId('user_prosthes_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
