<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RolesSeeder::class);

        $this->call(RolePermissionSeeder::class);
        $this->call(PermissionsSeeder::class);// اینجا اطمینان حاصل کنید که فقط Seeder را فراخوانی می‌کنید

    }
}
