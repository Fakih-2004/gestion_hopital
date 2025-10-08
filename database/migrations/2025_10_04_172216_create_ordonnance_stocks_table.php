<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ordonnance_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->foreignId('ordonnance_id')->constrained('ordonnances')->onDelete('cascade');
            $table->foreignId('pharmacie_stock_id')->constrained('pharmacie_stocks')->onDelete('cascade');
            $table->foreignId('pharmacien_id')->constrained('pharmaciens')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ordonnance_stocks');
    }
};
