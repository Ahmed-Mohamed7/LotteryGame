<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Misc\Helpers\Config;
use App\Http\Misc\Helpers\Errors;
use App\Services\Auth\LoginService;




/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------|
    | This controller handles the login  of  users as well as their
    | validation and creation.
    |
   */

class LoginController extends Controller
{
    protected $loginService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }


    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(LoginRequest $request)
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->error_response(Errors::ERROR_MSGS_422, 'Email & Password does not match with our record', 422);
            }
            // $user = User::where('email', $request->email)->first();
            $user = $this->loginService->GetUserByEmail($request->email);
            if (!$user)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this user is not found', 404);

            $response['user'] = $user;
            $token = $this->loginService->CreateToken($user);
            if (!$token)
                return $this->error_response(Errors::ERROR_MSGS_500, 'error in create token', 500);

            $response['token'] = $token;
            return $this->success_response($response, 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return 
     */
    public function logoutUser(Request $request)
    {
        try {
            auth('sanctum')->user()->tokens()->delete();
            return $this->success_response('user logout successfully', 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }
}
