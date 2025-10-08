<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{

    public function index()
    {
        return response()->json(Role::with('permissions')->get());
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array|exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return response()->json([
            'message' => 'Rôle créé avec succès',
            'role' => $role->load('permissions')
        ], 201);
    }


    public function show(Role $role)
    {
        return response()->json($role->load('permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array|exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return response()->json([
            'message' => 'Rôle mis à jour avec succès',
            'role' => $role->load('permissions')
        ]);
    }

    
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(['message' => 'Rôle supprimé avec succès']);
    }
}
