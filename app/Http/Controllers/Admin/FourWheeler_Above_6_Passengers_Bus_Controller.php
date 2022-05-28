<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Four_wheeler_above_6_passengers_bus_basic_rates;
use App\Models\Four_wheeler_above_6_passengers_bus_tp_additional_rates;
use App\Models\Four_wheeler_above_6_passengers_bus_basic_rates_tp_rates;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FourWheeler_Above_6_Passengers_Bus_Controller extends Controller
{
      
    public function index(){

        $policies =  Policies::get();
        
        $four_wheeler_bus_rate_chart = Four_wheeler_above_6_passengers_bus_basic_rates::orderBy('age')->get();

        // $four_wheeler_bus_tp_and_additional_charges  =  Four_wheeler_above_6_passengers_bus_tp_additional_rates::get();

        return view('admin.policies.four_wheeler_bus_basic_rate' ,compact('policies','four_wheeler_bus_rate_chart'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'policy_id' => "required|integer",
            'zone' => [
                'required',              
                Rule::in(['a','b','c']),
            ],
            'age' => "required|min:0|string",          
            'vehicle_basic_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $four_wheeler_bus_model =  Four_wheeler_above_6_passengers_bus_basic_rates::find($request->id);

                    }else{

                        $four_wheeler_bus_model = new Four_wheeler_above_6_passengers_bus_basic_rates();
                    }

                $four_wheeler_bus_model->policy_id = $request->policy_id;
                $four_wheeler_bus_model->zone = $request->zone;
        
                $four_wheeler_bus_model->age = $request->age;

                $four_wheeler_bus_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

                if($four_wheeler_bus_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Data Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $four_wheeler_bus_data = Four_wheeler_above_6_passengers_bus_basic_rates::find($id);

        if($four_wheeler_bus_data){
         return response()->json(['status' => 200,'four_wheeler_bus_data' => $four_wheeler_bus_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  Four_wheeler_above_6_passengers_bus_basic_rates::find($id);

        if( $model->delete()){


            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }
 
}
