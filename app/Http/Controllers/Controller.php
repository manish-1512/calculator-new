<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validateApi( $request ){

          

        if($request['apikey'] == ""){
            
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

        
		if($request->input('user_id') == null){

            $message = "Enter user_id.";
            
            return response()->json([
                "error",$message
            ]); die;
        }else{

                $userDetails	=	DB::table('users')->where('id',$request->input('user_id'))->first();
                if($userDetails != null ){
                    if($userDetails->is_active == 0){
                        $message = "Your account is banned. Please logout and login again or contact to support.";
                        // $response = $this->errorOutput("logout",$message,'');
                        // echo json_encode($response); die;

                        return response()->json([
                            "logout",$message,''
                        ]); die;
                    }
                }else{
                    $message = "Your account is deleted. Please logout and login again.";

                    return response()->json([
                        "logout",$message,''
                    ]); die;
                    // $response = $this->errorOutput("logout",$message,'');
                    // echo json_encode($response); die;
                }

        }
    }

}
