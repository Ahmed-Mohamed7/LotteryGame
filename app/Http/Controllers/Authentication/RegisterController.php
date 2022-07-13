<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Misc\Helpers\Config;
use App\Http\Misc\Helpers\Errors;
use App\Services\Auth\RegisterService;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------|
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
   */

    protected $RegisterService;


    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
   public function __construct(RegisterService $RegisterService)
   {
    //declare the service for user
      $this->RegisterService = $RegisterService;
   }


    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function RegisterUser(RegisterRequest $request)
    {
        try {
            $user = $this->RegisterService->CreateUser($request->all());
            if(!$user) 
                return $this->error_response(Errors::ERROR_MSGS_500, 'error in create user', 500);

            $request['user'] = $user;
            $token = $this->RegisterService->CreateToken($user);
            if(!$token)
                return $this->error_response(Errors::ERROR_MSGS_500, 'error in create toekn', 500);
            $request['token'] =  $token;
            return $this->success_response(new UserResource($request), 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }
}
