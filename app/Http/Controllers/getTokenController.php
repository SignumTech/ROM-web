<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class getTokenController extends Controller
{
    public function getUserToken(Request $request){
        $this->validate( $request, [
            "email" => "required|email",
            "password" => "required|string"
        ]);
        $user = User::where('email', $request->email)->first();
        if(!in_array($user->account_type, ["USER"])){
            return response("Access Denied", 401);
        }
        if (Hash::check($request->password, $user->password)) {
            if (Auth::check()){
                $request->user()->currentAccessToken()->delete();
            }
            $user_token = $user->createToken($user->name);

            return ['token' => $user_token->plainTextToken]; 
        }
        else{
            return response("Wrong credentials", 401);
        }
    }

}
