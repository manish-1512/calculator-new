<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class LoginController extends Controller
{
    

    public function login(Request $request){

               $credentials= $request->validate([
                    "email" => "required|email",
                    "password"=> "required",
                   
                ]

                
            
        );
            $credentials['is_active'] = 1; 
   

                if(Auth::attempt($credentials)){


                    return redirect()->route('admin.dashboard');


                }else{

                    return  redirect('admin')->with('wrong_details', ' You enter wrong email Or password');
                }
    
            // $user  =  User::where('email',$request->email)->first();

            // if( !empty($user) && (Hash::check($request->password,$user->password) )  ) {      
            //     session()->put('id',$user->id);    
            //     return redirect()->route('admin.dashboard');
                
            // }else{
                
            //     return  redirect()->back()->with('wrong_details', ' You enter wrong email Or password');
            // }
    }


    public function logout(){

        session()->flush();
        Auth::logout();
        return redirect('admin/');
    }

}
