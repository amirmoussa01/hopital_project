<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\MedecinController;  
use App\Http\Controllers\PharmacieController;  
use App\Http\Controllers\CaisseController; 
// ------------------------------------------
//  MODULE CAISSE (Lecture seule)
// ------------------------------------------

// Page d'accueil/recherche de la caisse
Route::get('/caisse', [CaisseController::class, 'index'])->name('caisse.index');

// Afficher la facture du patient
Route::post('/caisse/facture', [CaisseController::class, 'showFrais'])->name('caisse.show');


// ------------------------------------------
//  MODULE PHARMACIE (Lecture seule)
// ------------------------------------------

// Page d'accueil/recherche de la pharmacie
Route::get('/pharmacie', [PharmacieController::class, 'index'])->name('pharmacie.index');

// Afficher la prescription du patient (via POST pour la recherche)
Route::post('/pharmacie/prescription', [PharmacieController::class, 'showPrescription'])->name('pharmacie.show');

// ------------------------------------------
//  MODULE GESTION DES MÉDECINS (Nettoyé)
// ------------------------------------------

// Afficher le formulaire pour ajouter un médecin
Route::get('/medecins/creer', [MedecinController::class, 'create'])->name('medecins.create');

// Traiter l'enregistrement d'un nouveau médecin
Route::post('/medecins', [MedecinController::class, 'store'])->name('medecins.store');

// ------------------------------------------
//  MODULE CONSULTATION 
// ------------------------------------------
Route::get('/consultation/{patient}/creer', [MedecinController::class, 'createConsultation'])->name('consultation.create');
Route::post('/consultation/{patient}', [MedecinController::class, 'storeConsultation'])->name('consultation.store');

// ------------------------------------------
//  MODULE GESTION DES SALLES
// ------------------------------------------

// Afficher la liste des salles et le formulaire d'ajout
Route::get('/salles', [SalleController::class, 'index'])->name('salles.index');

// Traiter l'ajout d'une nouvelle salle
Route::post('/salles', [SalleController::class, 'store'])->name('salles.store');

// ------------------------------------------
//  MODULE D'ADMISSION
// ------------------------------------------

// Afficher le formulaire d'admission
Route::get('/admission/creer', [AdmissionController::class, 'create'])->name('admission.create');

// Traiter l'enregistrement de l'admission
Route::post('/admission', [AdmissionController::class, 'store'])->name('admission.store');

// ------------------------------------------
//  MODULE PATIENT (Vue Profil)
// ------------------------------------------

// Afficher le profil du patient après admission
Route::get('/patient/{patient}', [PatientController::class, 'show'])->name('patients.show');

// Route d'accueil simple
Route::get('/', function () {
    // Redirection vers l'outil principal ou une liste
    return redirect()->route('admission.create'); 
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
