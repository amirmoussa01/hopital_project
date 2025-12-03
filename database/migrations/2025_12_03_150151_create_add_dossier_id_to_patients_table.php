<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Relation avec la table 'dossiers' (Le dernier dossier actif)
            $table->foreignId('id_dossier')
                  ->after('id_salle') // Position du champ (optionnel)
                  ->nullable()
                  ->constrained('dossiers', 'id_dossier')
                  ->onDelete('set null'); // Set null si le dossier est supprimé
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Suppression de la clé étrangère et de la colonne
            $table->dropForeign(['id_dossier']);
            $table->dropColumn('id_dossier');
        });
    }
};
