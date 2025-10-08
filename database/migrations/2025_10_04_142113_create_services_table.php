<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('emplacement');
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->timestamps();
            $table->index('nom');
        });
<<<<<<< HEAD
        $table->index('nom');
=======

>>>>>>> c983371 (Fix migrations, seeders, models and add controllers and routes v1)

    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
