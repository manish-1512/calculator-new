<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliciesController extends Controller
{
        
    // public function __construct()
    // {
    //     $this->abc();
    // }

    // public function __construct(Request $request) {
  

	// 	if($request->input('apikey') == null){
	// 		$message = "Enter Api Key.";
            
    //         return response()->json([
    //             "error",$message
    //         ]); die;
		
	// 	}else{
	// 		if($request->get('apikey') != "240821"){
	// 			print_r($request->get('apikey')); die;
    //             $message = "Enter Valid Api Key.";
    //             return response()->json([
    //                 "error",$message
    //             ]); die;
                
    //             $response = $this->errorOutput("error",$message,'');
	// 			echo json_encode($response); die;
	// 		}
	// 	}
		



	// 	if(!empty($request->input('user_id'))){
	// 		$userDetails	=	DB::table('users')->where('id',$request->input('user_id'))->first();
	// 		if(!empty($userDetails)){
	// 			if($userDetails->is_active == 0){
	// 				$message = "Your account is banned. Please logout and login again or contact to support.";
	// 				$response = $this->errorOutput("logout",$message,'');
	// 				echo json_encode($response); die;
	// 			}
	// 		}else{
	// 			$message = "Your account is deleted. Please logout and login again.";
	// 			$response = $this->errorOutput("logout",$message,'');
	// 			echo json_encode($response); die;
	// 		}
	// 	}
		
	// }



    public function index(Request $request){



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

        
		if($request->input('user_id') == null){

            $message = "Enter user_id.";
            
            return response()->json([
                "error",$message
            ]); die;
        }else{
            echo $request->input('user_id');
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
	

         $policies = Policies::where('is_active',1)->OrderBy('order','ASC')->get();

                foreach($policies as $policy){

                   $policy->image = APP_PATH.POLICIES_IMAGES_URL.$policy->image; 
                }

         if(!$policies->isEmpty()){

            return response()->json([
                'status' => 'success',
                'message' => 'moter policies',
                'data' =>[
                    'list' => $policies
                ]
            ]);

         }else{

            return response()->json([
                'status' => 'error',
                'message' => 'You dont have policies',
                'data' =>[
                    
                ]
            ]);

         }


    }

}
