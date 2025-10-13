<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdonnanceStock;
use App\Models\PharmacieStock;

class OrdonnanceStockController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ordonnance_id' => 'required|exists:ordonnances,id',
            'pharmacie_stock_id' => 'required|exists:pharmacie_stocks,id',
            'pharmacien_id' => 'required|exists:pharmaciens,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $stock = PharmacieStock::findOrFail($request->pharmacie_stock_id);

        if ($stock->quantite_stock < $request->quantite) {
            return response()->json(['message' => 'Stock insuffisant'], 400);
        }

        $ordonnanceStock = OrdonnanceStock::create([
            'ordonnance_id' => $request->ordonnance_id,
            'pharmacie_stock_id' => $stock->id,
            'pharmacien_id' => $request->pharmacien_id,
            'quantite' => $request->quantite,
        ]);

        $stock->decrement('quantite_stock', $request->quantite);

        return response()->json($ordonnanceStock, 201);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'ordonnance_stock_id' => 'required|exists:ordonnance_stocks,id'
        ]);

        $ordonnanceStock = OrdonnanceStock::findOrFail($validated['ordonnance_stock_id']);
        $stock = $ordonnanceStock->pharmacieStock;

        if ($stock) {
            $stock->increment('quantite_stock', $ordonnanceStock->quantite);
        }

        $ordonnanceStock->delete();

        return response()->json([
            'message' => 'Médicament retiré de l’ordonnance et stock mis à jour'
        ], 200);
    }
}
