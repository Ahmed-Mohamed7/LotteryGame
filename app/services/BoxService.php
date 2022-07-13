<?php

namespace App\Services;

use App\Http\Misc\Helpers\Errors;
use App\Http\Requests\RegisterRequest;
use App\Models\Box;
use App\Models\BoxesItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class BoxService
{
    /**
     | this class is responsible for function implementation of box functions
     | process
     */

    /**
     * this function is responsible for get all boxes found in system
     * @param 
     * @return Boxes
     */
    public function GetAllBoxes()
    {
        try {
            $boxes = Box::all();
            return $boxes;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function CheckAuth()
    {
        return auth('sanctum')->user();
    }

    public function CreateBox(int $adminId)
    {
        try {
            $box = Box::create([
                'owner_id' => $adminId,
            ]);
            return $box;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function GetBoxInfo(int $boxId){
        $box = DB::table('boxes_items')
        ->join('boxes', 'boxes.id', '=', 'boxes_items.box_id')
        ->join('items', 'items.id', '=', 'boxes_items.items_id')
        ->where('boxes.id',$boxId)
        ->select('items.Name', 'items.Image', 'items.Description','boxes.sold','boxes_items.quanlity','boxes_items.price')
        ->get();
        if($box) return $box;
        else return null;
    }

    public function GetBoxPrice(int $boxId){
        $price = BoxesItem::where('box_id',$boxId)->sum('price');
        return $price;
    }
};
