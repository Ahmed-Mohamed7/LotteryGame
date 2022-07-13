<?php

namespace App\Services\Auth;

use App\Http\Misc\Helpers\Errors;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    /**
     | this class is responsible for function implementation of user registeration
     | process
     */

     /**
      * this function is responsible for create new user giving needed data
      * @param RegisterRequest $request
      * @return User
      */
    public function GetUserByEmail(string $email){
        $user = User::where('email', $email)->first();
        if($user) return $user;
        else return null;
    }
     
    public function CreateToken(User $user){
        try {
            return $user->createToken("API TOKEN")->plainTextToken;
        } catch (\Throwable $th) {
            return null;
        }
      
    }
};