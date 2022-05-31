<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MiscSpecialVehiclesModel;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MiscSpecialVehiclesController extends Controller
{
    public function index(){

        $policies =  Policies::get();

        $misc_vehicle_data = MiscSpecialVehiclesModel::get();

        return view('admin.policies.misc_special_vehicles' ,compact('policies','misc_vehicle_data'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'policy_id' => "required|integer",
            'zone' => [
                'required',              
                Rule::in(['a', 'b','c']),
            ],
            'age' => "required|min:0|string",
               
            'vehicle_basic_rate' => "required|numeric|min:0",
            "tp_other_misc_vehicle" => "required|numeric|min:0",
            "tp_agriculture_6hp" => "required|numeric|min:0"        
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $misc_vehicle_model =  MiscSpecialVehiclesModel::find($request->id);

                    }else{

                        $misc_vehicle_model = new MiscSpecialVehiclesModel();
                    }

                $misc_vehicle_model->policy_id = $request->policy_id;
                $misc_vehicle_model->zone = $request->zone;
        
                $misc_vehicle_model->age = $request->age;

                $misc_vehicle_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;

                $misc_vehicle_model->tp_other_misc_vehicle = (float) $request->tp_other_misc_vehicle;
                $misc_vehicle_model->tp_agriculture_6hp = (float) $request->tp_agriculture_6hp;
                

                if($misc_vehicle_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $misc_vehicle_data = MiscSpecialVehiclesModel::find($id);

        if($misc_vehicle_data){
         return response()->json(['status' => 200,'misc_vehicle_data' => $misc_vehicle_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  MiscSpecialVehiclesModel::find($id);
        if( $model->delete()){


            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    }
}
