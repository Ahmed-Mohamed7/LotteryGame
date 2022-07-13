<?php

namespace App\Http\Controllers;

use App\Models\BoxesItem;
use App\Models\Items;
use Illuminate\Http\Request;
use App\Http\Misc\Helpers\Config;
use App\Http\Misc\Helpers\Errors;
use App\Services\ItemService;

class BoxItemsController extends Controller
{

    protected $ItemService;


    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(ItemService $ItemService)
    {
        //declare the service for Item
        $this->ItemService = $ItemService;
    }

    /**
     * this function is responsible for add new item into a specific box
     * @param Request $request
     * @return Response
     */
    public function AddItemToBox(Request $request)
    {

        $validatedData = $this->ItemService->ValidateBoxItem($request);
        // check if they are already exist
        try {
            $boxItem = $this->ItemService->GetBoxItem($validatedData);

            $item = Items::find($validatedData['items_id']);
            if (!$item)
                return $this->error_response(Errors::ERROR_MSGS_404, 'item not found', 404);
            $price = $item->Price;
            // if found change only quantity and price
            if ($boxItem) {
                $this->ItemService->UpdateItem($boxItem, $price, $validatedData);
            } else {
                $validatedData['price'] = $price * $validatedData['quanlity'];
                $newboxItem = BoxesItem::create($validatedData);
                if (!$newboxItem) {
                    return $this->error_response(Errors::ERROR_MSGS_500, 'error while create new boxitem', 500);
                }
            }
            return $this->success_response('process done successfully', 201);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * this function is responsible for remove specific item into a specific box
     * @param Request $request
     * @return Response
     */
    public function RemoveItemFromBox(Request $request)
    {

        $validatedData = $this->ItemService->ValidateBoxItem2($request);

        try {
            $boxItem = $this->ItemService->GetBoxItem($validatedData);
            if (!$boxItem) {
                return response()->json('item is not found', 404);
            }
            $boxItem->delete();
            return $this->success_response('process done successfully', 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }
}
