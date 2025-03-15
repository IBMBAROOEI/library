<?php



namespace App\Action\Role;

use App\Models\Role;
use App\Models\User;


class GetRole{



 public function handel(User $user){


$roles=$user->roles()->with('permissions')->get();


     return $roles->map(function($role){
        return [

'role'=>$role->name,
 'permissions'=>$role->permissions->pluck('name'),
        ];
     })->toArray();
 }
}