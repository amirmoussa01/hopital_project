<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Affiche la liste de toutes les salles et le formulaire de création.
     */
    public function index()
    {
        // Récupère toutes les salles, triées par type
        $salles = Salle::orderBy('type')->get();
        
        return view('salles.index', compact('salles'));
    }

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

    // Vous pourriez ajouter ici des méthodes edit/update/destroy si nécessaire
}
