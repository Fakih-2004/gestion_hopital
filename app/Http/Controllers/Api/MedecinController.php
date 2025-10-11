<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medecin;


class MedecinController extends Controller
{

    public function index()
    {
        $medecins = Medecin::with('user', 'service')->get();

        return response()->json($medecins);
    }

    public function show($id)
    {
        $medecin = Medecin::with('user', 'service')->find($id);
        if (!$medecin) {
            return response()->json(['message' => 'Médecin non trouvé'], 404);
        }

        $data = [
            'id' => $medecin->id,
            'nom' => $medecin->user->name,
            'prenom' => explode(' ', $medecin->user->name)[1] ?? '',
            'email' => $medecin->user->email,
            'phone' => $medecin->user->phone,
            'service' => $medecin->service->nom ?? null,
        ];

        return response()->json($data);
    }
}
