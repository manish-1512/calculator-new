<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Four_wheeler_above_6_passengers_bus_tp_additional_rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FourWheeler_Above_6_Passengers_Bus_TpController extends Controller
{
    public function index(){
   
        $four_wheeler_bus_tp_additional_charges =   Four_wheeler_above_6_passengers_bus_tp_additional_rates::get();

        return view('admin.policies.four_wheeler_bus_tp_additional_charges' ,compact('four_wheeler_bus_tp_additional_charges'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [  
            'id' => "nullable|integer",
            'passenger' => "required|string",
            'additional_charges' => "required|numeric",
            'school_bus_tp' => "required|numeric",         
            'school_bus_per_person' => "required|numeric",
            'other_bus_tp' => "required|numeric",         
            'other_bus_per_person' => "required|numeric",         
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $four_wheeler_above_6_bus_tp_additional_model =  Four_wheeler_above_6_passengers_bus_tp_additional_rates::find($request->id);

                    }else{

                        $four_wheeler_above_6_bus_tp_additional_model = new Four_wheeler_above_6_passengers_bus_tp_additional_rates();
                    }

                    
                $four_wheeler_above_6_bus_tp_additional_model->passenger = $request->passenger;
                $four_wheeler_above_6_bus_tp_additional_model->additional_charges = $request->additional_charges;
                $four_wheeler_above_6_bus_tp_additional_model->school_bus_tp = $request->school_bus_tp;
                $four_wheeler_above_6_bus_tp_additional_model->school_bus_per_person = $request->school_bus_per_person;
                $four_wheeler_above_6_bus_tp_additional_model->other_bus_tp = $request->other_bus_tp;
                $four_wheeler_above_6_bus_tp_additional_model->other_bus_per_person = $request->other_bus_per_person;

                

                if($four_wheeler_above_6_bus_tp_additional_model->save()){

                    return response()->json(['status' => 200 ,'message' => " Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $bus_tp_additional_data = Four_wheeler_above_6_passengers_bus_tp_additional_rates::find($id);

        if($bus_tp_additional_data){
         return response()->json(['status' => 200,'bus_tp_additional_data' => $bus_tp_additional_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $model  =  Four_wheeler_above_6_passengers_bus_tp_additional_rates::find($id);

        if( $model->delete()){

            return response()->json(['status' => 200,'message' => "deleted"]);

        }
    }
}
