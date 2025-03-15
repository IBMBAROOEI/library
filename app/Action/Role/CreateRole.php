<?php

namespace App\Action\Role;

use App\Models\Role;
use App\Models\User;
use App\Traits\HasRolesAndPermissions;

class createRole
{

    use HasRolesAndPermissions;
    public function handle(User $user ,Role $role)
    {
     $user->assignRole($role);
    return $user;

    }
}
