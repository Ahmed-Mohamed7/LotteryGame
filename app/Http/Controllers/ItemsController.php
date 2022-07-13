<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemsRequest;
use App\Http\Resources\ItemResource;
use App\Models\Items;
use App\Http\Misc\Helpers\Config;
use App\Http\Misc\Helpers\Errors;
use App\Services\ItemService;


class ItemsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $items = $this->ItemService->GetAllItems();
            return $this->success_response(ItemResource::collection($items), 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *@param ItemsRequest
     * @return \Illuminate\Http\Response
     */
    public function create(ItemsRequest $request)
    {  
        try {
            $imageName = $this->ItemService->StoreImage($request);
            if ($imageName == null)
                return $this->error_response(Errors::ERROR_MSGS_500, 'error in saving image', 500);
            
            $item = $this->ItemService->CreateItem($request->all(),$imageName);
            return $this->success_response('item created successfully', 201);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = Items::find($id);
            if (!$item)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this item is not found', 404);

            return $this->success_response(new ItemResource($item), 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = Items::find($id);
            if (!$item)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this item is not found', 404);
            return $this->success_response(new ItemResource($item), 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemsRequest $request, $id)
    {
        $item = Items::find($id);
        if (!$item)
            return response()->json('item is not found', 404);
        $is_updated =  $item->update($request);
        if (!$is_updated)
            return response()->json('error in updating items', 500);
        return response()->json('item is updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = Items::find($id);
            // check whether this item is exist
            if (!$item)
                return response()->json('item is not found', 404);

            //delete this item
            $item->delete();

            return $this->success_response("item is successfully deleted", 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }
}
