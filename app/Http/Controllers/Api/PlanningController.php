<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index()
    {
        return response()->json(Planning::with('medecin')->get());
    }

    public function show($id)
    {
        $planning = Planning::with('medecin')->find($id);
        if (!$planning) return response()->json(['message' => 'Planning non trouvé'], 404);
        return response()->json($planning);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $planning = Planning::create($request->all());
        return response()->json($planning, 201);
    }

    public function update(Request $request, $id)
    {
        $planning = Planning::find($id);
        if (!$planning) return response()->json(['message' => 'Planning non trouvé'], 404);

        $planning->update($request->all());
        return response()->json($planning);
    }

    public function destroy($id)
    {
        $planning = Planning::find($id);
        if (!$planning) return response()->json(['message' => 'Planning non trouvé'], 404);

        $planning->delete();
        return response()->json(['message' => 'Planning supprimé']);
    }
}
