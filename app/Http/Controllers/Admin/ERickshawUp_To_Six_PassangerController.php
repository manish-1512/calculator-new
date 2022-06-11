<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\E_Rickshaw_up_to_6_passanger_rates;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ERickshawUp_To_Six_PassangerController extends Controller
{
    public function index(){

        $policies =  Policies::get();

        $e_rickshow_data = E_Rickshaw_up_to_6_passanger_rates::get();

        return view('admin.policies.e_rickshoe_upto_6_passanger' ,compact('policies','e_rickshow_data'));
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
                            
                        $e_rickShaw_model =  E_Rickshaw_up_to_6_passanger_rates::find($request->id);

                    }else{

                        $e_rickShaw_model = new E_Rickshaw_up_to_6_passanger_rates();
                    }

                $e_rickShaw_model->policy_id = $request->policy_id;
                $e_rickShaw_model->zone = $request->zone;
        
                $e_rickShaw_model->age = $request->age;

                $e_rickShaw_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                $e_rickShaw_model->vehicle_tp_rate =  $request->vehicle_tp_rate;
                $e_rickShaw_model->per_passengers_rate =  $request->per_passengers_rate;
                

                if($e_rickShaw_model->save()){
                    return response()->json(['status' => 200 ,'message' => "Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $e_rickshaw_upto_6_passanger_data = E_Rickshaw_up_to_6_passanger_rates::find($id);
        if($e_rickshaw_upto_6_passanger_data){
         return response()->json(['status' => 200,'e_rickshaw_upto_6_passanger_data' => $e_rickshaw_upto_6_passanger_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  E_Rickshaw_up_to_6_passanger_rates::find($id);
        if( $model->delete()){
            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    } 
}
