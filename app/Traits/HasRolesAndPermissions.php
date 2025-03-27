<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



trait HasRolesAndPermissions{


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function assignRole(...$roles)
    {
        $roles = is_array($roles[0]) ? $roles[0] : $roles;
        $this->roles()->sync($roles, false);
        return $this;
    }

    public function hasRole(string ...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles()->where('name', $role)->exists()) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyRole(...$roles): bool
    {
        $roles = is_array($roles[0]) ? $roles[0] : $roles;
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function hasPermissionTo(string $permission): bool
    {
                $roles=$this->roles()->with('permissions')->get();


            foreach($roles as $role){
                if($role->permissions->contains('name',$permission)){

                   return true;
        }

            }
        // بررسی دسترسی مستقیم
        return $this->hasDirectPermission($permission);
    }

    public function hasDirectPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
}
