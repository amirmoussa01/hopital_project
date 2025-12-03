@extends('layouts.app')

@section('title', 'Facturation')

@section('content')
    <a href="{{ route('caisse.index') }}" style="display: block; margin-bottom: 20px;">
        ← Retour à la Recherche Caisse
    </a>

    <h2>Facture Provisoire pour {{ $patient->prenom }} {{ $patient->nom }} (ID: {{ $patient->id_patient }})</h2>
    
    <div style="border: 2px solid #dc3545; padding: 20px; border-radius: 8px; background: #fff5f5;">
        <h3>Dossier N°{{ $dossier->id_dossier }} - Actes et Frais</h3>
        <p>Date de la Consultation : <strong>{{ $dossier->consultation->date->format('d/m/Y H:i') ?? 'N/A' }}</strong></p>
        <hr>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background: #f0f0f0;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Désignation</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Montant Estimé (Exemple)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Consultation Médicale (Acte du Dr. {{ $dossier->medecin->nom }})</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">100.00</td>
                </tr>
                <tr style="font-weight: bold;">
                    <td style="padding: 10px; border: 1px solid #ddd;">Frais d'Examens Demandés :</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; white-space: pre-wrap;">{{ $dossier->examen ?? 'Aucun examen (0.00)' }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">{{ $dossier->examen ? '75.00' : '0.00' }}</td>
                </tr>
                <tr style="font-weight: bold;">
                    <td style="padding: 10px; border: 1px solid #ddd;">Frais de Prescription Médicaments :</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; white-space: pre-wrap;">{{ $dossier->prescription ?? 'Aucun médicament (0.00)' }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">{{ $dossier->prescription ? '50.00' : '0.00' }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="background: #e0e0e0; font-weight: bold;">
                    <td style="padding: 10px; border: 1px solid #ddd;">TOTAL À PAYER (Facture Provisoire)</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">225.00</td> </tr>
            </tfoot>
        </table>
        
        <button style="background-color: #dc3545; margin-top: 20px;">Encaisser la Facture (Action non enregistrée en DB)</button>
    </div>
@endsection
