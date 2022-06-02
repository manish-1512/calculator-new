<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivateCarEv_kw_tp_rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivateCar_ev_kw_and_tp_Controller extends Controller
{
    public function index(){
   
        $private_car_ev_kw_tp_charges =   PrivateCarEv_kw_tp_rate::get();

        return view('admin.policies.private_car_ev_kw_cc_rates',compact('private_car_ev_kw_tp_charges'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'kw' => "required|string",
            'tp_one_year' => "required|numeric",
            'tp_three_year' => "required|numeric",         
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $private_car_ev_kw_tp_model =  PrivateCarEv_kw_tp_rate::find($request->id);

                    }else{

                        $private_car_ev_kw_tp_model = new PrivateCarEv_kw_tp_rate();
                    }

                    
                $private_car_ev_kw_tp_model->kw = $request->kw;

                $private_car_ev_kw_tp_model->tp_three_year = $request->tp_three_year;

                $private_car_ev_kw_tp_model->tp_one_year =  $request->tp_one_year;
                

                if($private_car_ev_kw_tp_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $private_car_ev_kw_tp_data = PrivateCarEv_kw_tp_rate::find($id);

        if($private_car_ev_kw_tp_data){
         return response()->json(['status' => 200,'private_car_ev_kw_tp_data' => $private_car_ev_kw_tp_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $private_car_ev_kw_tp_model  =  PrivateCarEv_kw_tp_rate::find($id);

        if( $private_car_ev_kw_tp_model->delete()){


            return response()->json(['status' => 200,'message' => "deleted"]);

        }
    }
}
