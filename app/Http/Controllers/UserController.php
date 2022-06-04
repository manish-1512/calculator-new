<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
        
            $request->user();
    }

    public function register(Request $request){

        $validator  = Validator::make($request->all(),[
            'name' => "required|string",
            'email' => "required|unique:users,email,email,id",
            'password' => "required|confirmed|min:6",
            'phone' => "required|between:10,10",
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 'failed' ,
                'message' => "validation error",
                'data' => $validator->errors()->toArray()
            ]);
        }else{

        $result = User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => bcrypt($request->password),
                    "phone" => $request->phone,

              ]);

        return response()->json([

                    'status' => "success",
                    'message' => "register successfully",
                    "data" =>               $result
                                   ],200);
        }
    }


    public function login(Request $request){
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); 

        if(Auth::attempt($credentials)){

            $user = Auth::user();

            return response()->json([
                 
                'status' => "success",
                'message' => "login successfully",
                    "data" => 
                            $user
                               ],200);

        }

        return response()->json([
            'status' => 'failed' ,
            'message' => "The provided credential do not match our records",
            'data' => [

            ],401
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
      }
    

}
