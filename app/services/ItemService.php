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



class ItemService
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
    public function GetAllItems()
    {
        $item = Items::all();
        if ($item)
            return $item;
        else
            return null;
    }
    /**
     * this function is responsible for storing the image
     * @param ItemsRequest $request
     * @return string
     */
    public function StoreImage(ItemsRequest $request)
    {
        $imageName = time() . '.' . $request->Image->extension();
        $request->Image->move(public_path('images'), $imageName);
        return $imageName;
    }

    public function CheckAuth()
    {
        return auth('sanctum')->user();
    }

    /**
     * this function is responsible for create Image
     * @param ItemsRequest $request
     * @return string
     */
    public function CreateItem(Array $request, string $imageName)
    {
        $item = Items::create([
            'Name' => $request['Name'],
            'Description' => $request['Description'],
            'Price' => $request['Price'],
            'Image' => $imageName,
        ]);
        if ($item)
            return $item;
        else
            return null;
    }

    /**
     * this function is responsible for Validating BoxItem
     * @param Request $request
     * @return Request
     */
    public function ValidateBoxItem(Request $request)
    {
        $validatedData = $request->validate([
            'box_id' => ['required', 'integer', 'exists:boxes,id'],
            'items_id' => ['required', 'integer', 'exists:items,id'],
            'quanlity' => ['required', 'integer', 'min:0', 'max:100'],
        ]);
        return $validatedData;
    }

      /**
     * this function is responsible for Validating BoxItem
     * @param Request $request
     * @return Request
     */
    public function ValidateBoxItem2(Request $request)
    {
        $validatedData = $request->validate([
            'box_id' => ['required', 'integer', 'exists:boxes,id'],
            'items_id' => ['required', 'integer', 'exists:items,id'],
        ]);
        return $validatedData;
    }

    /**
     * this function is responsible for get the boxitem
     * @param 
     * @return Request
     */
    public function GetBoxItem($validatedData)
    {
        $boxItem = BoxesItem::where('box_id', $validatedData['box_id'])
            ->where('items_id', $validatedData['items_id'])->first();
        if ($boxItem)
            return $boxItem;
        else
            return null;
    }

     /**
     * this function is responsible for update item 
     * @param $boxItem
     * @param int $price
     * @param object $validatedData
     * @return Request
     */
    public function UpdateItem($boxItem, int $price,$validatedData)
    {
        $boxItem->quanlity = $validatedData['quanlity'];
        $boxItem->price = $validatedData['quanlity'] * $price;
        $boxItem->save();
    }

};
