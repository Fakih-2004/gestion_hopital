<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->datetime('date_heure');
            $table->enum('statut', ['en_attente', 'confirmé', 'annulé'])->default('en_attente');

            // Relations
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
<<<<<<< HEAD
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade'); 
            $table->foreignId('planning_id')->constrained('plannings')->onDelete('cascade');
            $table->timestamps();

            $table->index('patient_id', 'date_heure', 'service_id');

=======
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade');
            $table->foreignId('planning_id')->nullable()->constrained('plannings')->onDelete('set null');

            $table->timestamps();

            $table->index(['patient_id', 'date_heure', 'service_id']);
>>>>>>> c983371 (Fix migrations, seeders, models and add controllers and routes v1)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
