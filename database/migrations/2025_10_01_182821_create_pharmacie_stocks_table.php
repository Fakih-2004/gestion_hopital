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
        Schema::create('pharmacie_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('code_article');
            $table->string('nom_article');
            $table->string('type_article');
            $table->date('date_expiration');
            $table->decimal('prix_achat', 8, 2);
            $table->decimal('prix_vente', 8, 2);
            $table->string('fournisseur');
            $table->boolean('statut')->default(1); 
            $table->integer('quantite_stock');
            $table->integer('quantite_min');
            $table->integer('quantite_max');
            $table->foreignId('pharmacien_id')->constrained('pharmaciens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacie_stocks');
    }
};
