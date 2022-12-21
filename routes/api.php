<?php

use App\Http\Controllers\Api\InvoicesApiController;
use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\SectionsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['api','changeLang'],'namespace'=>'Api'],function(){
    // route::post("getAll",[CategoryController::class,"index"]);
    // route::post("addCate",[CategoryController::class,"store"]);
    Route::Post("sections/all",[SectionsApiController::class,'index']);
    Route::post("sections/store",[SectionsApiController::class,'store']);

});
Route::get("invoices",[InvoicesApiController::class,'index']);
Route::post("invoices/store",[InvoicesApiController::class,'store']);
Route::post('update_invoice/',[InvoicesApiController::class,'update']);
Route::post('invoices/destroy',[InvoicesApiController::class,'destroy']);

Route::group(['middleware'=>'changeLang','namespace'=>'Api'],function(){
    Route::get("sections/all",[SectionsApiController::class,'index']);
    Route::post("sections/store",[SectionsApiController::class,'store']);
    Route::post("sections/update",[SectionsApiController::class,'update']);
    Route::post('sections/destroy',[SectionsApiController::class,'destroy']);
});



Route::get('products/all',[ProductsApiController::class,'index']);
Route::post('products/store',[ProductsApiController::class,'store']);
Route::post('products/update',[ProductsApiController::class,'update']);
Route::post('products/destroy',[ProductsApiController::class,'destroy']);



