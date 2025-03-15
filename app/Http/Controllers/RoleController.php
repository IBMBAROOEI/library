<?php

namespace App\Http\Controllers;

use App\Action\Role\createRole;
use App\Action\Role\GetRole;
use App\Action\Role\UpdateRole;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Log\Logger;
use App\log\log;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{




 public function __construct(

    protected CreateRole $createRole,
    protected GetRole $getRole,

    protected UpdateRole $updateRole,




    ){}




 public function updateRole(Request $request,User $user)
{
        $old_role_id = $request->input('old_role_id');
        $new_role_id = $request->input('new_role_id');
        $result=$this->updateRole->handel($user,$old_role_id,$new_role_id);

        return response()->json([

            'data' => $result
        ]);

}

public function showRole(User $user){

    $rolewithprmission=$this->getRole->handel($user);

    return response()->json([

        'data'=>$rolewithprmission
    ]);
}



public function assignroleuser(Request $request){


$user=User::find($request->input('user_id'));
$role = Role::find($request->input('role_id'));

$assignuser=$this->createRole->handle($user,$role);

return response()->json([
'data'=>$assignuser

]);

    }



}
