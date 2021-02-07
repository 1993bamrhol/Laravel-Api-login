<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request){
  
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|max:191',
            'password'=>'required|max:191'
        
        ],[
            'name.required'=>'الاسم مطلوب'
        ]);
        
        if($validator->fails())
        {
            return $validator->errors();
        }else{
            $data = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'api_token'=> Str::random(60),    
        ]);
        return $data;
        }
    }
}
