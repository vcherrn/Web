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

        Schema::create('active_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('request_id')->constrained('request_type');
            $table->boolean('request_status');
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50);
            $table->string('country', 50);
            $table->string('town', 50);
            $table->string('telephone_number', 20)->nullable();
            $table->string('user_email', 50)->nullable();
            $table->text('message_text')->nullable();
          //  $table->foreignId('request_type_user_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_requests');
    }
};
