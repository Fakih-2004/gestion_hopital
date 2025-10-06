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
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
            $table->date('date_prescription');
            $table->text('instruction_generale');
            $table->foreignId('rendez_vous_id')->constrained('rendez_vouses')->onDelete('cascade');
            $table->foreignId('pharmacien_id')->constrained('pharmaciens')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade'); 
            $table->timestamps();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');

            
            $table->index('pharmacien_id', 'rendez_vous');


            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordonnances');
    }
};
