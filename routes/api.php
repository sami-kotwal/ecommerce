<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// product state
Route::get('product/fetch',[ProductController::class,'index']);
Route::post('product/Add',[ProductController::class,'store']);
Route::put('product/Edit/{id}',[ProductController::class,'edit']);
Route::delete('product/Delete/{id}',[ProductController::class,'delete']);
// product end
// login state
Route::post('register',[UsersController::class,'register']);
Route::get('user/fetch',[UsersController::class,'index']);
Route::delete('user/delete/{id}',[UsersController::class,'delete']);
Route::post('login',[UsersController::class,'login']);
Route::post('logout',[UsersController::class,'logout']);

// login end

// category State
Route::get('category/fetch',[CategoryController::class,'Index']);
Route::post('category/Add',[CategoryController::class,'Store']);
Route::put('category/Edit/{id}',[CategoryController::class,'edit']);
Route::delete('category/Delete/{id}',[CategoryController::class,'delete']);
// category end

// order state
Route::get('order/fetch',[OrderController::class,'INdex']);
Route::post('order/Add',[OrderController::class,'Store']);
Route::put('order/Edit/{id}',[OrderController::class,'Edit']);
Route::delete('order/delete/{id}',[OrderController::class,'delete']);
// order end