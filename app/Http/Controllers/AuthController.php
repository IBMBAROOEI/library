<?php

namespace App\Http\Controllers;

use App\Action\Data\UserData;
use App\Action\User\Login;
use App\Action\User\Register;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{




 public function __construct(

    protected Register $register,
    protected Login $login,



    ){}



public function login(UserData $userdata){
$user=$this->login->handel($userdata);
Logger::log('warnin')
if(!$user){


      return response()->json([
                'message' => 'Invalid credentials',
            ], Response::HTTP_UNAUTHORIZED);
}
else{

    $userr=Auth::guard('api')->user();

    $token=JWTaUTH::FROMuSER($userr);


        return response()->json([
            'message'=>'user login',
'status'=>true,
'data'=> new UserResource($userr),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'refresh_token' => Auth::refresh(),

        ]);
}

}




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
