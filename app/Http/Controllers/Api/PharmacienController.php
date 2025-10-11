<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pharmacien;
use Illuminate\Http\Request;

class PharmacienController extends Controller
{
    
    public function index()
    {
        $pharmaciens = Pharmacien::with('user')->get();
        return response()->json($pharmaciens);
    }

    public function show($id)
    {
        $pharmacien = Pharmacien::with('user')->find($id);

        if (!$pharmacien) {
            return response()->json(['message' => 'Pharmacien non trouvé'], 404);
        }

        return response()->json($pharmacien);
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $pharmacien = Pharmacien::create([
            'user_id' => $request->user_id,
        ]);

        return response()->json($pharmacien, 201);
    }

    public function update(Request $request, $id)
    {
        $pharmacien = Pharmacien::find($id);

        if (!$pharmacien) {
            return response()->json(['message' => 'Pharmacien non trouvé'], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $pharmacien->update([
            'user_id' => $request->user_id,
        ]);

        return response()->json($pharmacien);
    }

    public function destroy($id)
    {
        $pharmacien = Pharmacien::find($id);

        if (!$pharmacien) {
            return response()->json(['message' => 'Pharmacien non trouvé'], 404);
        }

        $pharmacien->delete();

        return response()->json(['message' => 'Pharmacien supprimé']);
    }
}
