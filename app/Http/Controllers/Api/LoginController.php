<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(Request $request){
        if(Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])){
            $user = auth()->user();
            $user->api_token = Str::random(60);
            $user->save();
             return $user;
         }

         return "no";
         
    }

    public function logout(){
        if(auth()->user()){
            $user = auth()->user();
            $user->api_token = null;
            $user->save();
            return response()->json(['message'=>'you are logout']);

        }
        return response()->json([
            'error'=>'you can not logout',
            'code'=>401,
        ],401);
    }
}
