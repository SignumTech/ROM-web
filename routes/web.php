<?php

use Illuminate\Http\Request;
use App\Models\User;
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
    try {
        return Socialite::driver('google')->redirect();
    } catch (\Exception $e) {
        return redirect('/signin');
    }
    
});
 
Route::get('/auth/google/callback', function () {
    $socialite_user = Socialite::driver('google')->user();

    $user = User::where(['provider' => 'google', 'provider_id' => $socialite_user->getId()])->first();
    if(!user){
       $user = User::create([
            'f_name' => $socialite_user->user["given_name"],
            'l_name' => $socialite_user->user["family_name"],
            'email' => $socialite_user->getEmail(),
            'provider' => 'google',
            'provider_id' => $socialite_user->getId(),
            'email_verified_at' => now()
        ]);

        Auth::login($user);
    }

    return redirect('/');
    // $user->token
});
//////////////////////////////////////////////////
Route::any('{slug}', function () {
    return view('home');
});