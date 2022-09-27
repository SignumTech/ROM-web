<?php

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerUsersController;
use App\Http\Controllers\socialiteController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\addressBookController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\inventoriesController;
use App\Http\Controllers\flashSaleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chapaPay', [App\Http\Controllers\HomeController::class, 'chapaPay'])->name('chapaPay');
///////////////////////////////////resources///////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->resource('/categories', categoriesController::class);
Route::resource('/products', productsController::class);
Route::resource('/orders', ordersController::class);
Route::resource('/addressBooks', addressBookController::class);
Route::resource('/flashSales', flashSaleController::class);
///////////////////////////////////FlashSale////////////////////////////////////////////////////////////
Route::post('/addToflashSales', [flashSaleController::class, 'addToflashSales']);
Route::get('/getFlashProducts/{id}', [flashSaleController::class, 'getFlashProducts']);
Route::get('/getFlashSales', [flashSaleController::class, 'getFlashSales']);
///////////////////////////////////inventory/////////////////////////////////////////////////////////////
Route::post('/itemsInventory', [inventoriesController::class, 'itemsInventory']);
///////////////////////////////////address/////////////////////////////////////////////////////////////
Route::get('/showAddress/{id}', [addressBookController::class, 'showAddress']);
Route::get('/makeDefaultAddress/{id}', [addressBookController::class, 'makeDefaultAddress']);
///////////////////////////////////cart/////////////////////////////////////////////////////////////
Route::post('/addToCart', [cartController::class, 'addToCart']);
Route::post('/editCart', [cartController::class, 'editCart']);
Route::post('/getCart', [cartController::class, 'getCart']);
Route::put('/updateCart/{id}', [cartController::class, 'updateCart']);
Route::post('/deleteItem', [cartController::class, 'deleteItem']);
///////////////////////////////////orders/////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/getMyOrders', [ordersController::class, 'getMyOrders']);
Route::middleware('auth:sanctum')->get('/getMyOrdersStatus/{status}', [ordersController::class, 'getMyOrdersStatus']);
Route::middleware('auth:sanctum')->post('/repurchaseOrder', [ordersController::class, 'repurchaseOrder']);
Route::middleware('auth:sanctum')->get('/getProcessing', [ordersController::class, 'getProcessing']);
Route::middleware('auth:sanctum')->get('/getDelivered', [ordersController::class, 'getDelivered']);
Route::middleware('auth:sanctum')->get('/getShipped', [ordersController::class, 'getShipped']);
Route::middleware('auth:sanctum')->post('/shipOrder', [ordersController::class, 'shipOrder']);
///////////////////////////////////products/////////////////////////////////////////////////////////
Route::post('/uploadProductPic', [productsController::class, 'uploadProductPic']);
Route::post('/deleteProductImage', [productsController::class, 'deleteProductImage']);
Route::post('/insertColors', [productsController::class, 'insertColors']);
Route::post('/updateColors', [productsController::class, 'updateColors']);
Route::post('/filterData', [productsController::class, 'filterData']);
Route::get('/getProductsList', [productsController::class, 'getProductsList']);
Route::get('/getColorInventory/{id}', [productsController::class, 'getColorInventory']);
Route::get('/getInventory/{id}', [productsController::class, 'getInventory']);
Route::post('/updateSizes', [productsController::class, 'updateSizes']);
Route::post('/publishProduct', [productsController::class, 'publishProduct']);
Route::get('/productsByCategory/{id}', [productsController::class, 'productsByCategory']);
Route::get('/productFilters/{cat_id}', [productsController::class, 'productFilters']);
Route::get('/priceRange/{cat_id}', [productsController::class, 'priceRange']);
//////////////////////////////////auth//////////////////////////////////////////////////////////////
Route::post('/registerUser', [registerUsersController::class, 'registerUser']);
Route::post('/verifyOTP', [registerUsersController::class, 'verifyOTP']);
Route::post('/foregetPasswordMailer', [registerUsersController::class, 'foregetPasswordMailer']);
Route::post('/resetVerify', [registerUsersController::class, 'resetVerify']);
Route::post('/resetPassword', [registerUsersController::class, 'reset_password']);
Route::post('/resendOTP', [registerUsersController::class, 'resendOTP']);
Route::post('/updateInfo', [registerUsersController::class, 'updateInfo']);
////////////////////////////////////Categories//////////////////////////////////////////////////////
Route::get('/getMainCategories', [categoriesController::class, 'getMainCategories']);
Route::middleware('auth:sanctum')->get('/getSubCategories', [categoriesController::class, 'getSubCategories']);
Route::get('/showSubCategories/{id}', [categoriesController::class, 'showSubCategories']);
Route::middleware('auth:sanctum')->post('/uploadSubPic', [categoriesController::class, 'uploadSubPic']);
Route::middleware('auth:sanctum')->get('/chooseSubCategories', [categoriesController::class, 'chooseSubCategories']);
Route::get('/getCatByName/{name}', [categoriesController::class, 'getCatByName']);
///////////////socialites///////////////////////////////////////////////////////////////////////////
Route::get('/auth/google/redirect', [socialiteController::class, 'google_redirect']);
 
Route::get('/auth/google/callback', [socialiteController::class, 'google_callback']);

Route::get('/auth/facebook/redirect', [socialiteController::class, 'facebook_redirect']);
 
Route::get('/auth/facebook/callback', [socialiteController::class, 'facebook_callback']);
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////chapa integration/////////////////////////////////////////////
Route::post('pay', 'App\Http\Controllers\ChapaController@initialize')->name('pay');

Route::get('callback/{reference}', 'App\Http\Controllers\ChapaController@callback')->name('callback');
////////////////////////////////////////////////////////////////////////////////////////////////////
Route::any('{slug}', function () {
    return view('home');
});
Route::any('/admin/{slug}', function () {
    return view('home');
});
Route::any('/admin/{slug}/{slug2}', function () {
    return view('home');
});
Route::any('/admin/{slug}/{slug2}/{slug3}', function () {
    return view('home');
});
Route::any('/myAccount/{slug}', function () {
    return view('home');
});
Route::any('/myAccount/{slug}/{slug2}', function () {
    return view('home');
});
Route::any('/admin/editProduct/{slug}', function () {
    return view('home');
});
Route::any('{slug}/shopByCategory', function () {
    return view('home');
});
Route::any('{slug}/shopByCategory/{slug2}', function () {
    return view('home');
});