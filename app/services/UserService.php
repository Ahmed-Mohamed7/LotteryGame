<?php

namespace App\Services;

use App\Http\Misc\Helpers\Errors;
use App\Http\Requests\ItemsRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Box;
use App\Models\BoxesItem;
use App\Models\Items;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;



class UserService
{
    /**
     | this class is responsible for function implementation of User functions
     | process
     */

    public function GetPossibleWinners(){
        $boxes = DB::table('boxes')
        ->select(['boxes.owner_id', 'boxes_items.price'])
        ->join('boxes_items', 'boxes.id', '=', 'boxes_items.box_id')
        ->join('users','users.id' , '=' , 'boxes.owner_id')
        ->where('boxes.sold', true)
        ->where('users.admin',false);
        if($boxes)
            return $boxes;
        else 
            return null;
    }

    public function UpdateWinnerWallet($winner,$boxes){
        $total_price = 0.1 * $boxes->sum('price');
        $winner->wallet =  $winner->wallet  + $total_price;
        $winner->save();
    }
  

};
