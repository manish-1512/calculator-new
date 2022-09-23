<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class VehicleModelController extends Controller

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
                "status"=> "failed" ,
                 "message" =>   $message
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
    }  else{
       
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
                    "status"=> "failed" ,
                     "message" =>   $message
                ]); die;
                // $response = $this->errorOutput("logout",$message,'');
                // echo json_encode($response); die;
            }

    }

    if( empty($input['company_id'])){

        $message = "Enter company_id.";
        
        return response()->json([
            "status"=> "failed" ,
             "message" =>   $message
        ]); die;
        
    }

     $company_model = VehicleModel::select('id','vehicle_model')->where('vehicle_company_id',$input['company_id'])->get();


     if(!$company_model->isEmpty()){

        return response()->json([
            'status' => 'success',
            'message' => 'vehicle Model',
            'data' =>[
                'list' => $company_model
            ]
        ]);

     }else{

        return response()->json([
            'status' => 'error',
            'message' => 'You dont have model',
            'data' =>[
                
            ]
        ]);

     }


}
}
