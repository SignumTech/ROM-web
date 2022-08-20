<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerUsersController;
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

///////////////socialites//////////////
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    dd($user->getName(), $user->getEmail(), $user->getID());
    // $user->token
});
//////////////////////////////////////////////////
Route::any('{slug}', function () {
    return view('home');
});