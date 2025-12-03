<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{

    /**
     * Enregistre une nouvelle salle.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255|unique:salles,type',
        ]);

        Salle::create([
            'type' => $request->type,
        ]);

        return redirect()->route('salles.index')
                         ->with('success', 'La nouvelle salle de type "' . $request->type . '" a été créée.');
    }
    public function index()
    {
        $salles = Salle::orderBy('type')->withCount('patients')->get(); // On compte les patients
        return view('salles.index', compact('salles'));
    }
    public function edit(Salle $salle)
    {
        return view('salles.edit', compact('salle'));
    }

    /**
     * Met à jour la salle spécifiée.
     */
    public function update(Request $request, Salle $salle)
    {
        $request->validate([
            'type' => 'required|string|max:255|unique:salles,type,' . $salle->id_salle . ',id_salle',
        ]);

        $salle->update(['type' => $request->type]);

        return redirect()->route('salles.index')
                         ->with('success', 'Salle "' . $salle->type . '" mise à jour.');
    }

    /**
     * Supprime la salle spécifiée.
     */
    public function destroy(Salle $salle)
    {
        if ($salle->patients()->count() > 0) {
            return back()->withErrors('Impossible de supprimer cette salle : elle contient encore des patients ('.$salle->patients_count.').');
        }
        
        $salle->delete();

        return redirect()->route('salles.index')
                         ->with('success', 'Salle supprimée avec succès.');
    }

}
