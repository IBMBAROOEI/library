<?php

 namespace App\Action\User;

use Illuminate\Support\Facades\Auth;





class Profile{



public function handel(){

   return  Auth::user();
}

 }