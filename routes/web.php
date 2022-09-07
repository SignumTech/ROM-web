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
///////////////////////////////////resources///////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->resource('/categories', categoriesController::class);
Route::resource('/products', productsController::class);
Route::resource('/orders', ordersController::class);
Route::resource('/addressBooks', addressBookController::class);
///////////////////////////////////cart/////////////////////////////////////////////////////////////
Route::post('/addToCart', [cartController::class, 'addToCart']);
Route::post('/editCart', [cartController::class, 'editCart']);
Route::post('/getCart', [cartController::class, 'getCart']);
Route::put('/updateCart/{id}', [cartController::class, 'updateCart']);
Route::post('/deleteItem', [cartController::class, 'deleteItem']);
///////////////////////////////////products/////////////////////////////////////////////////////////
Route::post('/uploadProductPic', [productsController::class, 'uploadProductPic']);
Route::post('/deleteProductImage', [productsController::class, 'deleteProductImage']);
Route::post('/insertColors', [productsController::class, 'insertColors']);
Route::post('/updateColors', [productsController::class, 'updateColors']);
Route::get('/getProductsList', [productsController::class, 'getProductsList']);
Route::get('/getColorInventory/{id}', [productsController::class, 'getColorInventory']);
Route::get('/getInventory/{id}', [productsController::class, 'getInventory']);
Route::post('/updateSizes', [productsController::class, 'updateSizes']);
Route::post('/publishProduct', [productsController::class, 'publishProduct']);
Route::get('/productsByCategory/{id}', [productsController::class, 'productsByCategory']);
//////////////////////////////////auth//////////////////////////////////////////////////////////////
Route::post('/registerUser', [registerUsersController::class, 'registerUser']);
Route::post('/verifyOTP', [registerUsersController::class, 'verifyOTP']);
Route::post('/foregetPasswordMailer', [registerUsersController::class, 'foregetPasswordMailer']);
Route::post('/resetVerify', [registerUsersController::class, 'resetVerify']);
Route::post('/resetPassword', [registerUsersController::class, 'reset_password']);
Route::post('/resendOTP', [registerUsersController::class, 'resendOTP']);
////////////////////////////////////Categories//////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/getMainCategories', [categoriesController::class, 'getMainCategories']);
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
//////////////////////////////////////////////////
Route::any('{slug}', function () {
    return view('home');
});
Route::any('/admin/{slug}', function () {
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