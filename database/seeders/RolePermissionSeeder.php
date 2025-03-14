<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تعریف نقش و مجوزها
        $rolesPermissions = [
            'admin' => [
                'create-books',
                'read-books',
                'update-books',
                'delete-books',
                'create-categories',
                'read-categories',
                'update-categories',
                'delete-categories',
                'manage-users',
                'manage-roles',
                'manage-permissions',
            ],
            'editor' => [
                'read-books',
                'create-books',
                'update-books',
                'read-categories',
                'create-categories',
                'update-categories',
            ],
            'user' => [
                'read-books',
                'read-categories',
            ],
        ];

        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if ($role && $permission) {
                    $role->permissions()->attach($permission);
                }
            }
        }
    }
}
