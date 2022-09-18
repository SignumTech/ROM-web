<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerUsersController;
use App\Http\Controllers\getTokenController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\socialiteController;
use App\Http\Controllers\inventoriesController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\addressBookController;
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
Auth::routes();
///////////////////////////////////resources///////////////////////////////////////////////////////
Route::post('/mobGoogleLogin', [socialiteController::class, 'mobGoogleLogin']);
Route::post('/mobFacebookLogin', [socialiteController::class, 'mobFacebookLogin']);
Route::middleware('auth:sanctum')->resource('/orders', ordersController::class);
///////////////////////////////////orders/////////////////////////////////////////////////////////
Route::get('/getMyOrders', [ordersController::class, 'getMyOrders']);
Route::get('/getMyOrdersStatus/{status}', [ordersController::class, 'getMyOrdersStatus']);
Route::post('/repurchaseOrder', [ordersController::class, 'repurchaseOrder']);
///////////////////////////////////resources///////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->resource('/categories', categoriesController::class);
Route::resource('/products', productsController::class);
Route::middleware('auth:sanctum')->resource('/addressBooks', addressBookController::class);
///////////////////////////////////inventory/////////////////////////////////////////////////////////////
Route::post('/itemsInventory', [inventoriesController::class, 'itemsMobInventory']);
///////////////////////////////////address/////////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/showAddress/{id}', [addressBookController::class, 'showAddress']);
Route::middleware('auth:sanctum')->get('/makeDefaultAddress/{id}', [addressBookController::class, 'makeDefaultAddress']);
////////////////////////////////////Products////////////////////////////////////////////////////////
Route::get('/productsByCategory/{id}', [productsController::class, 'productsByCategory']);
Route::get('/getInventory/{id}', [productsController::class, 'getInventory']);
////////////////////////////////////Categories//////////////////////////////////////////////////////
Route::get('/getMainCategories', [categoriesController::class, 'getMainCategories']);
Route::get('/getSubCategories', [categoriesController::class, 'getSubCategories']);
Route::get('/showSubCategories/{id}', [categoriesController::class, 'showSubCategories']);
///////////////////////////////////cart/////////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->post('/getMobCart', [cartController::class, 'getMobCart']);
Route::middleware('auth:sanctum')->put('/updateMobCart/{id}', [cartController::class, 'updateMobCart']);
/////////////////////////////////auth//////////////////////////////////////////////////////////////////
Route::post('/getUserToken', [getTokenController::class, 'getUserToken']);
Route::post('/registerUser', [registerUsersController::class, 'registerUser']);
Route::post('/verifyOTP', [registerUsersController::class, 'verifyOTP']);
Route::post('/verifyMobileOTP', [registerUsersController::class, 'verifyMobileOTP']);
Route::post('/foregetPasswordMailer', [registerUsersController::class, 'foregetPasswordMailer']);
Route::post('/resetVerify', [registerUsersController::class, 'resetVerify']);
Route::post('/resetPassword', [registerUsersController::class, 'reset_password']);
Route::post('/resendOTP', [registerUsersController::class, 'resendOTP']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
