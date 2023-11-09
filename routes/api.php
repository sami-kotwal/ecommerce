<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('product/fetch',[ProductController::class,'index']);
Route::post('product/Add',[ProductController::class,'store']);
Route::put('product/Edit/{id}',[ProductController::class,'edit']);
Route::delete('product/Delete/{id}',[ProductController::class,'delete']);