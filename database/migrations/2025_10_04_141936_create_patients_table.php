<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('tele')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('adresse')->nullable();
            $table->date('date_naissance')->nullable();
            $table->boolean('is_new')->default(true);
            $table->timestamps();



            $table->index(['nom' ,'prenom','tele']);


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
