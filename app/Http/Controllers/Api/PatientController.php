<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return response()->json(Patient::all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'tele' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
            'date_naissance' => 'nullable|date',
        ]);

        $patient = Patient::create($request->all());
        return response()->json($patient, 201);
    }
}
