<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use App\Models\Three_wheeler_pcv_up_to_17_passengers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ThreeWheelerPCV_UpTo_17_PassengersController extends Controller
{
    public function index(){

        $policies =  Policies::get();

        $goods_carrying_data = Three_wheeler_pcv_up_to_17_passengers::get();

        return view('admin.policies.three_wheeler_pcv_up_to_17_passengers' ,compact('policies','goods_carrying_data'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [  
            'id' => "nullable|integer",
            'policy_id' => "required|integer",
            'zone' => [
                'required',             
                Rule::in(['a', 'b','c']),
            ],
            'age' => "required|string",      
            'vehicle_basic_rate' => "required|numeric|min:0" ,           
            'vehicle_tp_rate' => "required|numeric|min:0" ,           
            'per_passengers_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $three_wheeler_pcv_upto_17_model =  Three_wheeler_pcv_up_to_17_passengers::find($request->id);

                    }else{

                        $three_wheeler_pcv_upto_17_model = new Three_wheeler_pcv_up_to_17_passengers();
                    }

                $three_wheeler_pcv_upto_17_model->policy_id = $request->policy_id;
                $three_wheeler_pcv_upto_17_model->zone = $request->zone;
        
                $three_wheeler_pcv_upto_17_model->age = $request->age;

                $three_wheeler_pcv_upto_17_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                $three_wheeler_pcv_upto_17_model->vehicle_tp_rate =  $request->vehicle_tp_rate;
                $three_wheeler_pcv_upto_17_model->per_passengers_rate =  $request->per_passengers_rate;
                

                if($three_wheeler_pcv_upto_17_model->save()){
                    return response()->json(['status' => 200 ,'message' => "Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $three_wheeler_pcv_upto_17_data = Three_wheeler_pcv_up_to_17_passengers::find($id);
        if($three_wheeler_pcv_upto_17_data){
         return response()->json(['status' => 200,'three_wheeler_pcv_upto_17_data' => $three_wheeler_pcv_upto_17_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  Three_wheeler_pcv_up_to_17_passengers::find($id);
        if( $model->delete()){
            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    } 
}
