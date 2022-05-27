<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Four_wheeler_up_to_6_passengers_taxi;
use App\Models\Four_wheeler_up_to_6_passengers_taxi_tp_rates;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FourWheeler_UpTo_6_Passengers_Taxi_Controller extends Controller
{
    
    public function index(){

        $policies =  Policies::get();
        
        $four_wheeler_taxi_rate_chart = Four_wheeler_up_to_6_passengers_taxi::select('four_wheeler_upto_6_passengers_taxi.*','four_wheeler_upto_6_passengers_taxi_tp_rates.cc as cubic')->join('four_wheeler_upto_6_passengers_taxi_tp_rates','four_wheeler_upto_6_passengers_taxi_tp_rates.id','=','four_wheeler_upto_6_passengers_taxi.cc')->orderBy('age')->get();
        $cc_and_tp_for_taxi  =  Four_wheeler_up_to_6_passengers_taxi_tp_rates::get();

        return view('admin.policies.four_wheeler_text' ,compact('policies','four_wheeler_taxi_rate_chart','cc_and_tp_for_taxi'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'policy_id' => "required|integer",
            'zone' => [
                'required',              
                Rule::in(['a', 'b']),
            ],
            'age' => "required|min:0|string",
            'cc' => "required|string|min:0",           
            'vehicle_basic_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $four_wheeler_taxi_model =  Four_wheeler_up_to_6_passengers_taxi::find($request->id);

                    }else{

                        $four_wheeler_taxi_model = new Four_wheeler_up_to_6_passengers_taxi();
                    }

                $four_wheeler_taxi_model->policy_id = $request->policy_id;
                $four_wheeler_taxi_model->zone = $request->zone;
        
                $four_wheeler_taxi_model->age = $request->age;
                $four_wheeler_taxi_model->cc = $request->cc;

                $four_wheeler_taxi_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

                if($four_wheeler_taxi_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Data Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $four_wheeler_taxi = Four_wheeler_up_to_6_passengers_taxi::find($id);

        if($four_wheeler_taxi){
         return response()->json(['status' => 200,'four_wheeler_taxi' => $four_wheeler_taxi]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  Four_wheeler_up_to_6_passengers_taxi::find($id);

        if( $model->delete()){


            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }

}
