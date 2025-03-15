<?php


 namespace App\Action\Role;
use App\Models\Role;
use App\Models\User;



class UpdateRole{


     public function handel(User $user,int $old_role_id ,int $new_role_id){

$user->roles()->detach($old_role_id);

 return $user->assignRole($new_role_id);

     }
}