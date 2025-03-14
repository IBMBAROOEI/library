<?php


namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف تمام رکوردها از جدول Roles


        $roles = [
            ['name' => 'admin', 'description' => 'Administrator Role'],
            ['name' => 'editor', 'description' => 'Editor Role'],
            ['name' => 'user', 'description' => 'User Role'],
        ];

        foreach ($roles as $role) {


            Role::create([
                'name' => $role['name'],
                'description' => $role['description']
            ]);
        }

    }
}
