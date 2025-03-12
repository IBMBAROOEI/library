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
        Role::query()->delete(); // استفاده از query() برای دسترسی به متد delete

        Log::info("Starting to seed roles...");

        $roles = [
            ['name' => 'admin', 'description' => 'Administrator Role'],
            ['name' => 'editor', 'description' => 'Editor Role'],
            ['name' => 'user', 'description' => 'User Role'],
        ];

        foreach ($roles as $role) {

            Log::info($roles);

            Role::create([
                'name' => $role['name'],
                'description' => $role['description']
            ]);
        }

        Log::info("Roles seeded successfully.");
    }
}
