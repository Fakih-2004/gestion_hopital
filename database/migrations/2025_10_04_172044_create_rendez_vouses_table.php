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
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->datetime('date_heure');
            $table->enum('statut', ['en_attente', 'confirmé', 'annulé'])->default('en_attente');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade'); 
            $table->foreignId('planning_id')->constrained('plannings')->onDelete('cascade');
            $table->timestamps();

            $table->index('patient_id', 'date_heure', 'service_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
