<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ordonnance;


class OrdonnanceController extends Controller
{
    public function index()
    {
        $ordonnances = Ordonnance::with(['patient', 'medecin.user', 'pharmacien.user'])->get();
        return response()->json($ordonnances, 200);
    }

    public function show($id)
    {
        $ordonnance = Ordonnance::with(['patient', 'medecin.user', 'pharmacien.user'])->find($id);

        if (!$ordonnance) {
            return response()->json(['message' => 'Ordonnance non trouvée'], 404);
        }

        return response()->json($ordonnance, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_prescription' => 'required|date',
            'instruction_generale' => 'nullable|string',
            'pharmacien_id' => 'required|exists:pharmaciens,id',
            'medecin_id' => 'required|exists:medecins,id',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $ordonnance = Ordonnance::create($validated);

        return response()->json([
            'message' => 'Ordonnance créée avec succès',
            'data' => $ordonnance
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ordonnance = Ordonnance::find($id);

        if (!$ordonnance) {
            return response()->json(['message' => 'Ordonnance non trouvée'], 404);
        }

        $validated = $request->validate([
            'date_prescription' => 'sometimes|date',
            'instruction_generale' => 'nullable|string',
            'pharmacien_id' => 'sometimes|exists:pharmaciens,id',
            'medecin_id' => 'sometimes|exists:medecins,id',
            'patient_id' => 'sometimes|exists:patients,id',
        ]);

        $ordonnance->update($validated);

        return response()->json([
            'message' => 'Ordonnance mise à jour',
            'data' => $ordonnance
        ], 200);
    }

    public function destroy($id)
    {
        $ordonnance = Ordonnance::find($id);

        if (!$ordonnance) {
            return response()->json(['message' => 'Ordonnance non trouvée'], 404);
        }

        $ordonnance->delete();

        return response()->json([
            'message' => 'Ordonnance supprimée'
        ], 200);
    }
}
