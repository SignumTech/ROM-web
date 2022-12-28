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
use App\Http\Controllers\rolePermissionController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\customersController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\wishlistController;
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
Auth::routes();
Route::get('/', function () {
    return view('home');
});

Route::get('/forget', function (Request $request) {
    $request->session()->forget('cart');
});

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
/////////////////////////////////////whishlists///////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/addToWishlist/{id}', [wishlistController::class, 'addToWishlist']);
Route::middleware('auth:sanctum')->get('/getMyWishlist', [wishlistController::class, 'getMyWishlist']);
Route::middleware('auth:sanctum')->delete('/removeFromWishlist/{id}', [wishlistController::class, 'removeFromWishlist']);
/////////////////////////////////////dashboard////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/salesThirty', [dashboardController::class, 'salesThirty']);
Route::middleware('auth:sanctum')->get('/salesToday', [dashboardController::class, 'salesToday']);
Route::middleware('auth:sanctum')->get('/ordersThirty', [dashboardController::class, 'ordersThirty']);
Route::middleware('auth:sanctum')->get('/ordersToday', [dashboardController::class, 'ordersToday']);
Route::middleware('auth:sanctum')->get('/usersThirty', [dashboardController::class, 'usersThirty']);
Route::middleware('auth:sanctum')->get('/getOrdersByGroup', [dashboardController::class, 'getOrdersByGroup']);
Route::middleware('auth:sanctum')->get('/ordersSeven', [dashboardController::class, 'ordersSeven']);
Route::middleware('auth:sanctum')->get('/salesSeven', [dashboardController::class, 'salesSeven']);
Route::middleware('auth:sanctum')->get('/revenueYear', [dashboardController::class, 'revenueYear']);
Route::middleware('auth:sanctum')->post('/salesReport', [dashboardController::class, 'salesReport']);
/////////////////////////////////////Customers////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/getCustomers', [customersController::class, 'getCustomers']);
///////////////////////////////////staff/////////////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->post('/registerStaff', [staffController::class, 'registerStaff']);
Route::middleware('auth:sanctum')->post('/searchStaff', [staffController::class, 'searchStaff']);
Route::middleware('auth:sanctum')->get('/getStaff', [staffController::class, 'getStaff']);
Route::middleware('auth:sanctum')->get('/showStaff/{id}', [staffController::class, 'showStaff']);
Route::middleware('auth:sanctum')->post('/editStaff', [staffController::class, 'editStaff']);
Route::middleware('auth:sanctum')->post('/resetStaffPass', [staffController::class, 'resetStaffPass']);
Route::middleware('auth:sanctum')->get('/getStaffPermissions', [staffController::class, 'getStaffPermissions']);
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
Route::post('/addToCart', [cartController::class, 'addToCartNew']);
Route::post('/editCart', [cartController::class, 'editCart']);
Route::post('/getCart', [cartController::class, 'getCartNew']);
Route::put('/updateCart/{id}', [cartController::class, 'updateCart']);
Route::post('/deleteItem', [cartController::class, 'deleteItem']);
Route::middleware('auth:sanctum')->get('/getCartDetail', [cartController::class, 'getCartDetail']);
Route::middleware('auth:sanctum')->put('/updateCartItem/{id}', [cartController::class, 'updateCartItem']);
Route::post('/updateColorSize', [cartController::class, 'updateColorSize']);
///////////////////////////////////orders/////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/getMyOrders', [ordersController::class, 'getMyOrders']);
Route::middleware('auth:sanctum')->get('/getMyOrdersStatus/{status}', [ordersController::class, 'getMyOrdersStatus']);
Route::middleware('auth:sanctum')->post('/repurchaseOrder', [ordersController::class, 'repurchaseOrder']);
///////////////////////////////////products/////////////////////////////////////////////////////////
Route::post('/filterData', [productsController::class, 'filterData']);
Route::get('/getProductsList', [productsController::class, 'getProductsList']);
Route::get('/getColorInventory/{id}', [productsController::class, 'getColorInventory']);
Route::get('/getInventory/{id}', [productsController::class, 'getInventory']);
Route::get('/productsByCategory/{id}', [productsController::class, 'productsByCategory']);
Route::get('/productFilters/{cat_id}', [productsController::class, 'productFilters']);
Route::get('/priceRange/{cat_id}', [productsController::class, 'priceRange']);
Route::get('/getFeatured/{id}', [productsController::class, 'getFeatured']);
Route::post('/searchItems', [productsController::class, 'searchItems']);
Route::get('/getPreviewData/{id}', [productsController::class, 'getPreviewData']);
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
Route::get('/showMainCat/{id}', [categoriesController::class, 'showMainCat']);
///////////////socialites///////////////////////////////////////////////////////////////////////////
Route::get('/auth/google/redirect', [socialiteController::class, 'google_redirect']);
 
Route::get('/auth/google/callback', [socialiteController::class, 'google_callback']);

Route::get('/auth/facebook/redirect', [socialiteController::class, 'facebook_redirect']);
 
Route::get('/auth/facebook/callback', [socialiteController::class, 'facebook_callback']);
////////////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->post('/createRolePermission', [rolePermissionController::class, 'createRolePermission']);
Route::middleware('auth:sanctum')->post('/updateRolePermission', [rolePermissionController::class, 'updateRolePermission']);
Route::middleware('auth:sanctum')->get('/getRoles', [rolePermissionController::class, 'getRoles']);
Route::middleware('auth:sanctum')->get('/getRoles/{id}', [rolePermissionController::class, 'showRole']);
Route::middleware('auth:sanctum')->delete('/deleteRole/{id}', [rolePermissionController::class, 'deleteRole']);
//////////////////////////////////////chapa integration/////////////////////////////////////////////
Route::post('pay', 'App\Http\Controllers\ChapaController@initialize')->name('pay');

Route::get('callback/{reference}', 'App\Http\Controllers\ChapaController@callback')->name('callback');
Route::get('return_url/{reference}', 'App\Http\Controllers\ChapaController@return_url')->name('return_url');
////////////////////////////////////////////////////////////////////////////////////////////////////
Route::any('{slug}', function () {
    return view('home');
});

Route::any('home/{slug}/shop/{slug2}', function () {
    return view('home');
});
Route::middleware(['pagePermission'])->any('/admin/{slug}', function () {
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
Route::any('/search/{slug}', function () {
    return view('home');
});
Route::any('/home/{slug}', function () {
    return view('home');
});

Route::any('{slug}/shopByCategory/{slug2}', function () {
    return view('home');
});