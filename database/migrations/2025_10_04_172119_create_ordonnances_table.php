<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
            $table->date('date_prescription');
            $table->text('instruction_generale')->nullable();

     
            $table->foreignId('pharmacien_id')->constrained('pharmaciens')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->timestamps();


            $table->index(['pharmacien_id', 'medecin_id', 'patient_id'], 'ordonnance_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordonnances');
    }
};

