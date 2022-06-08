<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

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


    public function forgotPassword(Request $request){

        if($request->input('apikey') == null){
			$message = "Enter Api Key.";
            
            return response()->json([
                "error",$message
            ]); die;
		
		}else{
			if($request->input('apikey') != "964912"){
				
                $message = "Enter Valid Api Key.";
                return response()->json([
                    "error",$message
                ]); die;
                
                $response = $this->errorOutput("error",$message,'');
				echo json_encode($response); die;
			}
		}

        
        if($request->email == null){

            return response()->json([
                "status"=> 401,
                "error" => [
                    "email"=> ["the email field is required"]
                    ]
            ]);
        }



            $check_user_data =  User::where('email',$request->email)->first();

            if($check_user_data == null){

                return response()->json([
                    'status' => 'failed' ,
                    'message' => "The provided credential do not match our records",
                    'data' => [
        
                    ],401
                ]);

            }else{
                
              //  $otp = rand(100000,999999);
                 $otp = 123456;

                 $check_user_data->otp = $otp;
                  
                  $check_user_data->save();

                    $details = [
                        "title" => "this is title",
                        "body" => $otp
                    ];  
                
                

                    if ( Mail::to("kumarvijesh089@gmail.com")->send(new NotifyMail($details))) {

                        return response()->json([
                            'status' => 'success' ,
                            'message' => "Great! OTP Successfully send to your mail",
                            'data' => [
                
                            ],200
                        ]);
                        
                     }else{
                        

                        return response()->json([
                            'status' => 'failed' ,
                            'message' => "Sorry! Please try again latter",
                            'data' => [
                
                            ],401
                        ]);
                      }
            }




    }


    public function verifyOtp(Request $request){

        
        if($request->input('apikey') == null){
			$message = "Enter Api Key.";
            
            return response()->json([
                "error",$message
            ]); die;
		
		}else{
			if($request->input('apikey') != "964912"){
				
                $message = "Enter Valid Api Key.";
                return response()->json([
                    "error",$message
                ]); die;
                
                $response = $this->errorOutput("error",$message,'');
				echo json_encode($response); die;
			}
		}


        $validator = Validator::make($request->all(), [  

            'email' => "required|email",
            'otp' => "required|string",         
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{ 

                $check_user_data =  User::where('email',$request->email)->where('otp',$request->otp)->first();

                if($check_user_data == null){

                    return response()->json([
                        'status' => 'failed' ,
                        'message' => "Invalid OTP",
                        'data' => [
                        ],401
                    ]);

                }else{

                    return response()->json([
                        'status' => 'success' ,
                        'message' => "Otp has Been Verify",
                        'data' => [
                        ],200
                    ]);
                }
             
        }
    }


    public function resetPassword(Request $request){


        if($request->input('apikey') == null){
			$message = "Enter Api Key.";
            
            return response()->json([
                "error",$message
            ]); die;
		
		}else{
			if($request->input('apikey') != "964912"){
				
                $message = "Enter Valid Api Key.";
                return response()->json([
                    "error",$message
                ]); die;
                
                $response = $this->errorOutput("error",$message,'');
				echo json_encode($response); die;
			}
		}


        $validator = Validator::make($request->all(), [  
            'email' => "required|email",
            'password' => "required|min:6",         
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{ 

                $check_user_data = User::where('email',$request->email)->first();

                if($check_user_data != null){

                    $check_user_data->password = bcrypt($request->password);
                    $check_user_data->otp = Null;

                    if($check_user_data->save()){

                        $check_user_data->otp  = Null;

                        $check_user_data->save();

                        return response()->json([
                            'status' => 'success' ,
                        'message' => "Password Updated",
                        'data' => [
                        ],200
                        ]);

                    }else{

                        return response()->json([
                         'status' => 'failed' ,
                        'message' => "Password  Not  Updated",
                        'data' => [
                        ],401
                        ]);

                    }

                }

        }

    }



    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
      }
    

}
