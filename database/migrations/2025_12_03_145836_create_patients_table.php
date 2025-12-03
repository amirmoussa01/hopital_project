<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('id_patient'); // Votre identifiant personnalisé
            $table->string('nom');
            $table->string('prenom');
            $table->string('tel')->nullable();
            $table->integer('age')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('statut')->default('Admis'); // Statut initial

            // Relation avec la table 'salles'
            // ON DELETE SET NULL permet de garder le patient s'il quitte la salle
            $table->foreignId('id_salle')->nullable()->constrained('salles', 'id_salle')->onDelete('set null');

            // IMPORTANT : Nous allons ajouter id_dossier dans une migration ultérieure
            // pour éviter une dépendance circulaire avec la table 'dossiers'.
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
