<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Planning;

class RendezVousController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'tele' => 'required|string',
            'email' => 'nullable|email',
            'service_id' => 'required|exists:services,id',
            'date_heure' => 'required|date_format:Y-m-d H:i:s',
        ]);

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

       
        $plannings = Planning::whereHas('medecin', function ($q) use ($request) {
                $q->where('service_id', $request->service_id);
            })
            ->where('date', date('Y-m-d', strtotime($request->date_heure)))
            ->where('heure_debut', '<=', date('H:i:s', strtotime($request->date_heure)))
            ->where('heure_fin', '>=', date('H:i:s', strtotime($request->date_heure)))
            ->with('medecin.user')
            ->get();

        if ($plannings->isEmpty()) {
            return response()->json(['message' => 'Aucun créneau disponible pour ce service à cette heure.'], 404);
        }

       
        $planningDisponible = null;
        foreach ($plannings as $planning) {
            $dejaPris = RendezVous::where('medecin_id', $planning->medecin->id)
                ->where('date_heure', $request->date_heure)
                ->exists();

            if (!$dejaPris) {
                $planningDisponible = $planning;
                break;
            }
        }

        if (!$planningDisponible) {
            return response()->json([
                'message' => 'Tous les médecins du service sont occupés à cette heure. Veuillez choisir un autre créneau.'
            ], 409);
        }


        $rendezVous = RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $planningDisponible->medecin->id,
            'service_id' => $request->service_id,
            'planning_id' => $planningDisponible->id,
            'date_heure' => $request->date_heure,
        ]);

        return response()->json([
            'message' => 'Rendez-vous créé avec succès ✅',
            'rendez_vous' => $rendezVous,
            'medecin' => [
                'nom' => $planningDisponible->medecin->user->name ?? null,
                'email' => $planningDisponible->medecin->user->email ?? null,
                'phone' => $planningDisponible->medecin->user->phone ?? null,
            ],
            'planning' => [
                'date' => $planningDisponible->date,
                'heure_debut' => $planningDisponible->heure_debut,
                'heure_fin' => $planningDisponible->heure_fin,
            ],
        ], 201);
    }
}
