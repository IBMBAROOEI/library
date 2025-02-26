<?php

namespace App\Http\Controllers;

use App\Action\Data\UserData;
use App\Action\User\Register;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{




 public function __construct(

    protected Register $register,



    ){}

     public function register(UserData $userdata){

try{

$user=$this->register->handel($userdata);
  $token = JWTAuth::fromUser($user);



return response()->json([
'message'=>'user creted',
'status'=>true,
'data'=> new UserResource($user),
'token'=>$token,

],201);

}

    catch(\Exception $e){
    return response()->json([
'message'=>'errors',
'status'=>false,
'errors'=>$e->getMessage()

],500);

    }
    }







}
