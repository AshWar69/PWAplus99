<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DisplayController;
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
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function(){
    
    /**===================User Section=======================**/
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('updateProfile', [UserController::class, 'edit']);
        Route::post('updateAddress', [UserController::class, 'update']);
        Route::post('getAddress', [UserController::class, 'show']);
        Route::post('logout', [AuthController::class, 'logout']);
    /**===================End User Section=======================**/

    /**=================Categories Section===================**/

        Route::get('FetchCategory', [DisplayController::class, 'index']);
        //Route::post('SingleCategory/{id}', [DisplayController::class, 'fetchSingleCat']);
        Route::get('FetchCompany/{id}', [DisplayController::class, 'show']);
        Route::get('FetchModel/{cid}/{cat_id}', [DisplayController::class, 'fetchModel']);
        Route::get('FetchProducts/{model}', [DisplayController::class, 'fetchProduct']);
        Route::post('AddToCart', [DisplayController::class, 'addCart']);
        Route::post('PlaceOrder', [DisplayController::class, 'placeOrder']);

    /**=================End Categories Section===================**/
    
    /**=================Banners Section===================**/

        Route::get('Banners', [DisplayController::class, 'getBanners']);

    /**=================End Banners Section===================**/
});

