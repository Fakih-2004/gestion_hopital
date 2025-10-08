<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        
        $permissions = [
            
            'manage users',
            'manage roles',
            'manage permissions',

            
            'view patients',
            'create patients',
            'edit patients',
            'delete patients',

            'view planning',
            'edit planning',
            'delete planning',
            'create planning',

            
            'view appointments',
            'create appointments',
            'edit appointments',
            'cancel appointments',

            'manage ordonnances',
            'manage stock',

      
            'manage billing',

            'send notifications',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles and their permissions
        $rolesPermissions = [
            'admin' => Permission::all()->pluck('name')->toArray(),
            'medecin' => [
                'view patients',
                'edit patients',
                'view planning',
                'edit planning',
                'manage ordonnances',
            ],
            'infirmier' => [
                'view patients',
                'view appointments',
            ],
            'secretaire' => [
                'view patients',
                'create patients',
                'create appointments',
                'edit appointments',
                'cancel appointments',
                'view planning',
                'edit planning',
            ],
            'pharmacien' => [
                'manage ordonnances',
                'manage stock',
            ],
            'comptable' => [
                'manage billing',
            ],
        ];

        foreach ($rolesPermissions as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }
    }
}
