<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Planning;

class RendezVousController extends Controller
{
    // Créer un rendez-vous
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'tele' => 'required|string',
            'email' => 'nullable|email',
            'service_id' => 'required|exists:services,id',
            'date_heure' => 'required|date',
        ]);

        // Créer ou récupérer le patient
        $patient = Patient::firstOrCreate(
            ['tele' => $request->tele],
            [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'adresse' => $request->adresse ?? null,
                'date_naissance' => $request->date_naissance ?? null,
            ]
        );

        // Chercher un médecin disponible pour ce service et date
        $medecin = Medecin::where('service_id', $request->service_id)
                    ->whereHas('plannings', function($q) use ($request) {
                        $q->where('date_debut', '<=', $request->date_heure)
                          ->where('date_fin', '>=', $request->date_heure);
                    })
                    ->inRandomOrder()
                    ->first();

        if (!$medecin) {
            return response()->json(['message' => 'Aucun médecin disponible à cette date'], 404);
        }

        // Récupérer le planning correspondant
        $planning = $medecin->plannings()
                    ->where('date_debut', '<=', $request->date_heure)
                    ->where('date_fin', '>=', $request->date_heure)
                    ->first();


        $rendezVous = RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $medecin->id,
            'service_id' => $request->service_id,
            'planning_id' => $planning->id,
            'date_heure' => $request->date_heure,
        ]);

        return response()->json([
            'message' => 'Rendez-vous créé avec succès',
            'rendez_vous' => $rendezVous,
            'medecin' => [
                'nom' => $medecin->nom,
                'prenom' => $medecin->prenom,
                'specialite' => $medecin->specialite,
            ],
        ], 201);
    }

    // Lister tous les rendez-vous (admin ou médecin)
    public function index()
    {
        $rvs = RendezVous::with(['patient', 'medecin', 'service', 'planning'])->get();
        return response()->json($rvs);
    }

    // Voir un rendez-vous
    public function show($id)
    {
        $rv = RendezVous::with(['patient', 'medecin', 'service', 'planning'])->find($id);
        if (!$rv) return response()->json(['message' => 'Rendez-vous non trouvé'], 404);

        return response()->json($rv);
    }
}
