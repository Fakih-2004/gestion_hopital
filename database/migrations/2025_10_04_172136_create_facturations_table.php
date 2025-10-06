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
        Schema::create('facturations', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant');
            $table->enum('statut', ['payé', 'impayé', 'en_attente'])->default('en_attente');
            $table->date('date_facture');
            $table->date('date_echeance');
            $table->string('mode_paiement');
            $table->foreignId('rendez_vous_id')->constrained('rendez_vouses')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturations');
    }
};
