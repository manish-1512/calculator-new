<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VehicleCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class VehicleCompaniesController extends Controller
{
    public function index(){

        $input =   FacadesRequest::json()->all();


        if( empty($input['apikey'])){
			$message = "Enter Api Key.";
            
            return response()->json([
                "error",$message
            ]); die;
		
		}else{
			if($input['apikey'] != "964912"){
				
                $message = "Enter Valid Api Key.";
                return response()->json([
                    "error",$message
                ]); die;
                
                $response = $this->errorOutput("error",$message,'');
				echo json_encode($response); die;
			}
		}

        
		if( empty($input['user_id'])){

            $message = "Enter user_id.";
            
            return response()->json([
                "error",$message
            ]); die;
        }else{
           
                $userDetails	=	DB::table('users')->where('id',$input['user_id'])->first();
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
	

         $company = VehicleCompanies::select('id','title')->where('is_active',1)->OrderBy('order_by')->get();

            

         if(!$company->isEmpty()){

            return response()->json([
                'status' => 'success',
                'message' => 'vehicle company',
                'data' =>[
                    'list' => $company
                ]
            ]);

         }else{

            return response()->json([
                'status' => 'error',
                'message' => 'You dont have company',
                'data' =>[
                    
                ]
            ]);

         }


    }
}
