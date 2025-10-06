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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->foreignId('to_user_id')->constrained('users')->onDelete('cascade'); 
            $table->enum('channel', ['sms', 'email', 'app'])->default('app');
            $table->text('message'); 
            $table->foreignId('rendez_vous_id')->constrained('rendez_vouses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
