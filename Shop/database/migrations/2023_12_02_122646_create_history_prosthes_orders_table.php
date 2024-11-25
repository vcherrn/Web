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

        Schema::create('history_prosthes_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('history_orders');
            $table->foreignId('prosthes_id')->constrained('prosthes');
            $table->integer('count');
            //$table->timestamp('created_at')->nullable();
           // $table->foreignId('history_order_prosthes_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_prosthes_orders');
    }
};
