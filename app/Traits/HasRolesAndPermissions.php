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



    public function assignRole(...$role){

        $role=is_array($role[0])?$role[0]:$role;

        $this->roles()->sync($role,false);
        return $this;
    }

    public function hasRole(string $role):bool{

        return $this->roles()->wherIn('name',$role)->exists();
    }


    public function hasAnyRole(...$role):bool
    {

        $role = is_array($role[0]) ? $role[0] : $role;
        return $this->roles()->wherIn('name', $role)->exists();
    }


    public function hasPermissionTo($permission){
        return $this->permissions()->where('name', $permission);
    }

}