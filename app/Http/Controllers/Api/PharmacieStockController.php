<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PharmacieStock;
use Illuminate\Http\Request;

class PharmacieStockController extends Controller
{
    public function index()
    {
        $stocks = PharmacieStock::with('pharmacien')->get();
        return response()->json($stocks, 200);
    }

    public function show($id)
    {
        $stock = PharmacieStock::with('pharmacien')->find($id);
        if (!$stock) {
            return response()->json(['message' => 'Stock non trouvé'], 404);
        }
        return response()->json($stock, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_article' => 'required|string|unique:pharmacie_stocks,code_article',
            'nom_article' => 'required|string',
            'type_article' => 'required|string',
            'date_expiration' => 'required|date',
            'prix_achat' => 'required|numeric',
            'prix_vente' => 'required|numeric',
            'fournisseur' => 'nullable|string',
            'quantite_stock' => 'required|integer',
            'quantite_min' => 'required|integer',
            'quantite_max' => 'required|integer',
            'pharmacien_id' => 'required|exists:pharmaciens,id',
        ]);

        $stock = PharmacieStock::create($request->all());

        return response()->json($stock, 201);
    }

    public function update(Request $request, $id)
    {
        $stock = PharmacieStock::find($id);
        if (!$stock) {
            return response()->json(['message' => 'Stock non trouvé'], 404);
        }

        $request->validate([
            'code_article' => 'sometimes|string|unique:pharmacie_stocks,code_article,' . $stock->id,
            'nom_article' => 'sometimes|string',
            'type_article' => 'sometimes|string',
            'date_expiration' => 'sometimes|date',
            'prix_achat' => 'sometimes|numeric',
            'prix_vente' => 'sometimes|numeric',
            'fournisseur' => 'sometimes|string',
            'quantite_stock' => 'sometimes|integer',
            'quantite_min' => 'sometimes|integer',
            'quantite_max' => 'sometimes|integer',
            'pharmacien_id' => 'sometimes|exists:pharmaciens,id',
        ]);

        $stock->update($request->all());
        return response()->json($stock, 200);
    }

    public function destroy($id)
    {
        $stock = PharmacieStock::find($id);
        if (!$stock) {
            return response()->json(['message' => 'Stock non trouvé'], 404);
        }

        $stock->delete();
        return response()->json(['message' => 'Stock supprimé avec succès'], 200);
    }
}
