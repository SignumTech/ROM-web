<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerUsersController;
use App\Http\Controllers\socialiteController;
use Laravel\Socialite\Facades\Socialite;
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
Route::post('/registerUser', [registerUsersController::class, 'registerUser']);
Route::post('/verifyOTP', [registerUsersController::class, 'verifyOTP']);
Route::post('/foregetPasswordMailer', [registerUsersController::class, 'foregetPasswordMailer']);
Route::post('/resetVerify', [registerUsersController::class, 'resetVerify']);
Route::post('/resetPassword', [registerUsersController::class, 'reset_password']);
Route::post('/resendOTP', [registerUsersController::class, 'resendOTP']);

///////////////socialites//////////////
Route::get('/auth/google/redirect', [socialiteController::class, 'google_redirect']);
 
Route::get('/auth/google/callback', [socialiteController::class, 'google_callback']);

Route::get('/auth/facebook/redirect', [socialiteController::class, 'facebook_redirect']);
 
Route::get('/auth/facebook/callback', [socialiteController::class, 'facebook_callback']);
//////////////////////////////////////////////////
Route::any('{slug}', function () {
    return view('home');
});
Route::any('{slug}/shopByCategory', function () {
    return view('home');
});