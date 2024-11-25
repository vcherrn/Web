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

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50);
            $table->string('country', 50);
            $table->string('town', 50);
            $table->string('area', 50);
            $table->string('street', 50);
            $table->string('house', 10);
            $table->string('apartment', 10);
            $table->string('telephone_number', 20)->nullable();
            $table->string('user_email', 50)->nullable();
            $table->text('message_text')->nullable();
            $table->decimal('order_sum', 8, 2)->nullable();
           // $table->timestamp('created_at')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
