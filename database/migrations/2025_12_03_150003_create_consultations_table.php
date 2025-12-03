<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('id_consultation'); // Votre identifiant personnalisé
            $table->timestamp('date'); // Date de la consultation

            // Relations
            $table->foreignId('id_patient')->constrained('patients', 'id_patient')->onDelete('cascade');
            $table->foreignId('id_medecin')->constrained('medecins', 'id_medecin')->onDelete('restrict');
            
            // Relation 1:1 avec dossier
            $table->foreignId('id_dossier')->unique()->constrained('dossiers', 'id_dossier')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
