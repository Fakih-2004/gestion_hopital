<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    
    public function index()
    {
        return response()->json(Permission::all());
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Permission créée avec succès',
            'permission' => $permission
        ], 201);
    }

    
    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Permission mise à jour',
            'permission' => $permission
        ]);
    }

    public function destroy(Permission  $permission)
    {
        $permission->delete();

        return response()->json([
            'message' => 'Permission supprimée avec succès'
        ]);
    }
}
