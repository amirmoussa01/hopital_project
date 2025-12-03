<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\ConsultationController; 
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\DashboardController;

// ------------------------------------------
//  TABLEAU DE BORD (Racine)
// ------------------------------------------
// Lier la racine au nouveau DashboardController
Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); 
// ------------------------------------------
//  CRUD SALLE
// ------------------------------------------
Route::resource('salles', SalleController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);


// ------------------------------------------
//  CRUD MÉDECIN
// ------------------------------------------
Route::resource('medecins', MedecinController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);


// ------------------------------------------
//  CRUD PATIENT & ADMISSION
// ------------------------------------------
// Patient Resource (Liste, Modification, Suppression)
Route::resource('patients', PatientController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);

// Admission (Création)
Route::get('/admission/creer', [AdmissionController::class, 'create'])->name('admission.create');
Route::post('/admission', [AdmissionController::class, 'store'])->name('admission.store');


// ------------------------------------------
//  MODULE CONSULTATION
// ------------------------------------------
// Liste de toutes les consultations
Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');

// Consultation pour un patient (création / enregistrement)
Route::get('/consultation/{patient}/creer', [MedecinController::class, 'createConsultation'])->name('consultation.create');
Route::post('/consultation/{patient}', [MedecinController::class, 'storeConsultation'])->name('consultation.store');


// ------------------------------------------
//  MODULES LECTURE SEULE
// ------------------------------------------
Route::get('/pharmacie', [PharmacieController::class, 'index'])->name('pharmacie.index');
Route::post('/pharmacie/prescription', [PharmacieController::class, 'showPrescription'])->name('pharmacie.show');

Route::get('/caisse', [CaisseController::class, 'index'])->name('caisse.index');
Route::post('/caisse/facture', [CaisseController::class, 'showFrais'])->name('caisse.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
