<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Http\Misc\Helpers\Errors;
use App\Services\BoxService;


class boxController extends Controller
{

    protected $BoxService;


    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
   public function __construct(BoxService $BoxService)
   {
    //declare the service for user
      $this->BoxService = $BoxService;
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $boxes = $this->BoxService->GetAllBoxes();
            return $this->success_response($boxes, 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $admin = auth('sanctum')->user();
            if(!$admin)
                return $this->error_response(Errors::ERROR_MSGS_401,'',401);

            $box = $this->BoxService->CreateBox($admin->id);
            if(!$box)
                return $this->error_response(Errors::ERROR_MSGS_500, 'error in create box', 500);

            return $this->success_response("box created successfully", 201);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            //check if the box is found
            $box = Box::find($id);
            if(!$box)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this box is not found', 404);
            // get box info
            $box = $this->BoxService->GetBoxInfo($id);
            if (!$box)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this item is not found', 404);
            $response['box'] = $box;
            // get box price
            $price = $this->BoxService->GetBoxPrice($id);
            $response['price'] = $price;
            return $this->success_response($response, 200);
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
    public function update(Request $request, $id)
    {
        //
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
            $box = Box::find($id);
            // check whether this item is exist
            if (!$box)
                return $this->error_response(Errors::ERROR_MSGS_404, 'this box is not found', 404);

            //delete this item
            $box->delete();

            return $this->success_response("box is successfully deleted", 200);
        } catch (\Throwable $th) {
            return $this->error_response(Errors::ERROR_MSGS_500, $th, 500);
        }
    }
}
