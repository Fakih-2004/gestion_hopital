<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    
    public function index()
    {
        return response()->json(Service::all());
    }

    
    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) return response()->json(['message' => 'Service non trouvé'], 404);
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:services,nom',
            'emplacement' => 'nullable|string',
            'statut' => 'in:actif,inactif'
        ]);

        $service = Service::create($request->all());
        return response()->json($service, 201);
    }

   
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) return response()->json(['message' => 'Service non trouvé'], 404);

        $request->validate([
            'nom' => 'string|unique:services,nom,' . $id,
            'emplacement' => 'nullable|string',
            'statut' => 'in:actif,inactif'
        ]);

        $service->update($request->all());
        return response()->json($service);
    }


    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) return response()->json(['message' => 'Service non trouvé'], 404);

        $service->delete();
        return response()->json(['message' => 'Service supprimé']);
    }
}
