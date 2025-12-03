<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Salle;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $patientsAdmis = Patient::where('statut', 'Admis')->count();
        $patientsSortis = Patient::where('statut', 'Sorti')->count();
        $patientsEnConsultation = Patient::where('statut', 'En_Consultation')->count();
        
        // ... (autres stats existantes) ...

        // 2. Data for Charts
        // Chart 1: Répartition des statuts
        $patientStatusData = [
            'Admis' => $patientsAdmis,
            'En Consultation' => $patientsEnConsultation,
            'Sorti' => $patientsSortis,
        ];

        // Chart 2: Top 5 Consultations par Médecin
        $consultationsParMedecin = Consultation::select('id_medecin', DB::raw('count(*) as count'))
                                      ->groupBy('id_medecin')
                                      ->orderByDesc('count')
                                      ->take(5)
                                      ->get()
                                      ->map(function ($item) {
                                          $medecin = Medecin::find($item->id_medecin);
                                          return [
                                              'name' => $medecin ? 'Dr. ' . $medecin->nom : 'Inconnu',
                                              'count' => $item->count,
                                          ];
                                      })->toArray();
        
        // 3. Collecte des données pour la vue
        $stats = [
            'totalPatients' => $totalPatients,
            'patientsAdmis' => $patientsAdmis,
            'patientsSortis' => $patientsSortis,
            'patientsEnConsultation' => $patientsEnConsultation,
            'tauxOccupation' => $totalPatients > 0 ? round(($patientsAdmis / $totalPatients) * 100, 1) : 0,
            'totalMedecins' => Medecin::count(),
            'sallesDisponibles' => Salle::has('patients', '<', 5)->count(),
            'totalConsultations' => Consultation::count(),
        ];
        
        $dernieresConsultations = Consultation::with(['patient', 'medecin'])
                                            ->latest('date')
                                            ->take(5)
                                            ->get();

        return view('dashboard.index', compact('stats', 'dernieresConsultations', 'patientStatusData', 'consultationsParMedecin'));
    }
}
