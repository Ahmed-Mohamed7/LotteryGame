<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\BoxesItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Misc\Helpers\Config;
use App\Http\Misc\Helpers\Errors;
use App\Services\UserService;

/*
    |--------------------------------------------------------------------------
    | User Controller 
    |--------------------------------------------------------------------------|
    | This controller handles the operations done by the users
    |
   */

class UserController extends Controller
{

    protected $UserService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService)
    {
        //declare the service for Item
        $this->UserService = $UserService;
    }

    /**
     * this function is responsible for Get user profile
     * @param Request $request
     * @param int $id
     * @return User 
     */
    public function GetProfile(Request $request)
    {
        try {
            $user = auth("sanctum")->user();
            return $this->success_response($user, 200);
        } catch (\Throwable $th) {
            $error["user"] = "error in get user";
            return $this->error_response(Errors::ERROR_MSGS_500, $error, 500);
        }
    }

    /**
     * Get the user by id
     * @param Request $request
     * @param int $id
     * @return User 
     */
    public function GetUserById(Request $request, int $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->error_response(Errors::ERROR_MSGS_404, '', 404);
            }
            // only the user who can view his own wallet
            //if user made the request is authenticated user check if he is the same as required user
            if (auth('sanctum')->check() && !auth('sanctum')->user()->cannot('view', $user)) {
                $user = $user;
            } else {
                unset($user['wallet']);
            }
            return $this->success_response($user, 200);
        } catch (\Throwable $th) {
            $error["user"] = "cannot get user";
            return $this->error_response(Errors::ERROR_MSGS_500, $error, 500);
        }
    }

    /**
     * Get boxes of the user
     * @param int $id
     * @return Array Boxes 
     */
    public function GetUserBoxs(int $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->error_response(Errors::ERROR_MSGS_404, 'user not found', 404);
            }
            $boxes = $user->boxes()->get();
            return $this->success_response($boxes, 200);
        } catch (\Throwable $th) {
            $error["boxes"] = 'error in get user boxes';
            return $this->error_response(Errors::ERROR_MSGS_500, $error, 500);
        }
    }

    /**
     * user buy box
     * @param int $id
     * @return Array Boxes 
     */
    public function buybox(Request $request, int $id)
    {
        try {
            $user = auth('sanctum')->user();
            //admin cannot buy boxes
            if ($user->admin)
                return $this->error_response(Errors::ERROR_MSGS_422, 'admin can\'t buy boxes', 422);
            $box = Box::where('id', $id)->first();
            if (!$box)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this box is not found', 404);
            //check if box is already sold
            if ($box->sold)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this box is already sold', 404);

            $boxPrice = BoxesItem::where('box_id', $box->id)->sum('price');
            // check if the user cannot buy the box
            if ($user->wallet < $boxPrice) {
                return $this->error_response(Errors::ERROR_MSGS_422, 'you don\'t have enough to buy this box', 422);
            }
            // update user wallet
            $user->wallet = $user->wallet - $boxPrice;
            $user->save();

            $box->owner_id = $user->id;
            $box->sold = true;
            $box->save();
            return $this->success_response('you bought the box successfully', 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    public function SelectWinner()
    {
        try {
            $boxes = DB::table('boxes')
                ->select(['boxes.owner_id', 'boxes_items.price'])
                ->join('boxes_items', 'boxes.id', '=', 'boxes_items.box_id')
                ->join('users', 'users.id', '=', 'boxes.owner_id')
                ->where('boxes.sold', true)
                ->where('users.admin', false);

            $boxes = $this->UserService->GetPossibleWinners();
            if (!$boxes)
                return $this->error_response(Errors::ERROR_MSGS_404, 'no boxes to select', 404);

            $winner_id =  $boxes->inRandomOrder()->first()->owner_id;
            $winner = User::find($winner_id);

            //update winner wallet
            $this->UserService->UpdateWinnerWallet($winner, $boxes);
            $winStatement = 'user : ' . $winner->firstName . ' wins';
            //    $winner->notify();
            return $this->success_response($winStatement, 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }
}
