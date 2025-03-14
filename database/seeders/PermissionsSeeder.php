<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {


        $permissions = [
            'create-books' => 'Create Books',
            'read-books' => 'Read Books',
            'update-books' => 'Update Books',
            'delete-books' => 'Delete Books',
            'create-categories' => 'Create Categories',
            'read-categories' => 'Read Categories',
            'update-categories' => 'Update Categories',
            'delete-categories' => 'Delete Categories',
            'manage-users' => 'Manage Users',
            'manage-roles' => 'Manage Roles',
            'manage-permissions' => 'Manage Permissions',
        ];

        foreach ($permissions as $name => $label) {
            Permission::create([
                'name' => $name,
                'lable' => $label
            ]);
        }
    }
}
