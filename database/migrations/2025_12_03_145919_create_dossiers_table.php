<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id('id_dossier'); // Votre identifiant personnalisé
            
            // Le contenu médical
            $table->text('consultation_resume')->nullable(); // Résumé de la consultation (symptômes, diagnostic)
            $table->text('prescription')->nullable();
            $table->text('examen')->nullable();
            
            // Relations
            $table->foreignId('id_patient')->constrained('patients', 'id_patient')->onDelete('cascade');
            $table->foreignId('id_medecin')->constrained('medecins', 'id_medecin')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
