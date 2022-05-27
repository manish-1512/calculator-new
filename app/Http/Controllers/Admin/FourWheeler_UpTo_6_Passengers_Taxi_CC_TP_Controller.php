<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Four_wheeler_up_to_6_passengers_taxi_tp_rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FourWheeler_UpTo_6_Passengers_Taxi_CC_TP_Controller extends Controller
{
    public function index(){
   
        $four_wheeler_taxi_cc_tp_charges =   Four_wheeler_up_to_6_passengers_taxi_tp_rates::get();

        return view('admin.policies.four_wheeler_taxi_tp_rates' ,compact('four_wheeler_taxi_cc_tp_charges'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'cc' => "required|string",
            'tp_rate' => "required|numeric",
            'rate_per_passanger' => "required|numeric",         
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $taxi_cc_tp_model =  Four_wheeler_up_to_6_passengers_taxi_tp_rates::find($request->id);

                    }else{

                        $taxi_cc_tp_model = new Four_wheeler_up_to_6_passengers_taxi_tp_rates();
                    }

                    
                $taxi_cc_tp_model->cc = $request->cc;

                $taxi_cc_tp_model->tp_rate = $request->tp_rate;

                $taxi_cc_tp_model->rate_per_passanger = $request->rate_per_passanger;

                

                if($taxi_cc_tp_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $taxi_cc_tp_data = Four_wheeler_up_to_6_passengers_taxi_tp_rates::find($id);

        if($taxi_cc_tp_data){
         return response()->json(['status' => 200,'taxi_cc_tp_data' => $taxi_cc_tp_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $model  =  Four_wheeler_up_to_6_passengers_taxi_tp_rates::find($id);

        if( $model->delete()){

            return response()->json(['status' => 200,'message' => "deleted"]);

        }
    }
}
