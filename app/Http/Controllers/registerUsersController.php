<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTP;
class registerUsersController extends Controller
{
    public function registerUser(Request $request){
        $this->validate($request, [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'preference' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->password = Hash::make($request->password);
        $user->account_type = "USER";
        $user->otp = rand(1000 , 9999);
        $user->save();


    }

    public function sendEmail()
    {
        $user = collect(array('name'=>'Fnote', 'otp'=>'1234'));
        $user_detail = User::first();
        Mail::to($user_detail)->send(new OTP($user_detail));
        /*Mail::send('otp', $user, function($message){
            $message->to('fnote.md@gmail.com', 'test')->subject('test');
            $message->from('no-reply@signumdev.com', 'Fnote');
        });*/
    }
}
