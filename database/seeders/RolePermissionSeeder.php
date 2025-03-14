<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();


        if ($adminRole && $editorRole && $userRole) {



         $adminpermissions = Permission::whereIn('name',[

                'create-books' ,
                'read-books',
                'update-books' ,
                'delete-books' ,
                'create-categories',
                'read-categories',
                'update-categories',
                'delete-categories',
                'manage-users' ,
                'manage-roles' ,
                'manage-permissions',

            ])->pluck('id');
         $adminRole->permissions()->syncWithoutDetaching($adminpermissions);

          Log::info($adminpermissions);




            $editorpermissions = Permission::whereIn('name', [
                'create-books',
                'read-books',
                'update-books',
                'delete-books',
                'create-categories',
                'read-categories',
                'update-categories',
                'delete-categories',

            ])->pluck('id');


            $editorRole->permissions()->syncWithoutDetaching($editorpermissions);

            Log::info($editorpermissions);





            $userpermissions = Permission::whereIn('name', [

                'read-books',
                'read-categories',
            ])->pluck('id');


            $userRole->permissions()->syncWithoutDetaching($userpermissions);

            Log::info($userpermissions);

        }
    }
}
