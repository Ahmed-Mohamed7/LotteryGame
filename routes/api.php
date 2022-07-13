<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\boxController;
use App\Http\Controllers\BoxItemsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//User
//AUTH
Route::post('/auth/register', [RegisterController::class, 'RegisterUser']);
Route::post('/auth/login', [LoginController::class, 'loginUser']);
Route::post('/auth/logout', [LoginController::class, 'logoutUser'])->middleware('auth:sanctum');

Route::get('user/{id}',[UserController::class,'GetUserById']);
Route::get('userBoxes/{id}',[UserController::class,'GetUserBoxs']);
Route::post('buybox/{id}',[UserController::class,'buybox'])->middleware('auth:sanctum');
Route::get('selectWinner',[UserController::class,'SelectWinner'])->middleware('auth:sanctum')->middleware('admin');
Route::get('profile',[UserController::class,'GetProfile'])->middleware('auth:sanctum');

// boxes
Route::apiResource('box',boxController::class);
Route::apiResource('box',boxController::class)->only(['destroy'])->middleware('auth:sanctum')->middleware('admin');
Route::post('/box/', [boxController::class, 'create'])->middleware('auth:sanctum')->middleware('admin');

// items
Route::apiResource('item',ItemsController::class)->middleware('auth:sanctum')->middleware('admin');
Route::post('/item/', [ItemsController::class, 'create'])->middleware('auth:sanctum')->middleware('admin');

Route::post('fillbox/', [BoxItemsController::class, 'AddItemToBox'])->middleware('auth:sanctum')->middleware('admin');
Route::delete('removeBoxItem/', [BoxItemsController::class, 'RemoveItemFromBox'])->middleware('auth:sanctum')->middleware('admin');
