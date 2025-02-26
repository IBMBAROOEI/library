<?php
 namespace App\Action\User;

use App\Action\Data\UserData;
use App\Model\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;

  class Register{



 public function handel(UserData $userdata){

    $data=$userdata->toArray();

    $data['password']=Hash::make($data['password']);

    return ModelsUser::create($data);

 }

  }
