<?php

namespace App\Action\User;
use App\Action\Data\UserData;
use App\Model\User;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;

class Login {

 public function handel(UserData $userData){


    $data=$userData->toArray();


    return  Auth::attempt($data);
 }

}
