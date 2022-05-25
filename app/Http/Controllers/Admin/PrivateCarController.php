<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use App\Models\PrivateCar_cc_tp;
use App\Models\PrivateCarModelRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PrivateCarController extends Controller
{
    
    public function index(){

        $policies =  Policies::get();
        
        $private_car_rate_chart = PrivateCarModelRate::select('private_car_rates.*','private_car_cc_tp_charges.cc as cubic')->join('private_car_cc_tp_charges','private_car_cc_tp_charges.id','=','private_car_rates.cc')->orderBy('age')->get();

        $cc_and_tp_for_private_car  =  PrivateCar_cc_tp::get();

        return view('admin.policies.private_car' ,compact('policies','private_car_rate_chart','cc_and_tp_for_private_car'));
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
                            
                        $private_car_rate_model =  PrivateCarModelRate::find($request->id);

                    }else{

                        $private_car_rate_model = new PrivateCarModelRate();
                    }

                $private_car_rate_model->policy_id = $request->policy_id;
                $private_car_rate_model->zone = $request->zone;
        
                $private_car_rate_model->age = $request->age;
                $private_car_rate_model->cc = $request->cc;

                $private_car_rate_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

                if($private_car_rate_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $two_wheeler_one_year_data = PrivateCarModelRate::find($id);

        if($two_wheeler_one_year_data){
         return response()->json(['status' => 200,'two_wheeler_one_year_data' => $two_wheeler_one_year_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $policy_model  =  PrivateCarModelRate::find($id);

        if( $policy_model->delete()){


            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }

}
