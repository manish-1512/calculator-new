<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivateCarEv_kw_tp_rate;
use App\Models\PrivateCarEvBasicRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PrivateCarEVController extends Controller
{
      
    public function index(){

        
         $private_car_ev_rate_chart = PrivateCarEvBasicRateModel::select('private_car_ev_basic_rates.*','private_car_ev_kw_tp_rates.kw as kilowatt')->join('private_car_ev_kw_tp_rates','private_car_ev_kw_tp_rates.id','=','private_car_ev_basic_rates.kw')->orderBy('age')->get();

         $kw_and_tp_for_private_car  =  PrivateCarEv_kw_tp_rate::get();

        return view('admin.policies.private_car_ev_basic',compact('kw_and_tp_for_private_car','private_car_ev_rate_chart'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'zone' => [
                'required',              
                Rule::in(['a', 'b']),
            ],
            'age' => "required|min:0|string",
            'kw' => "required|integer",
            'vehicle_basic_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $private_car_ev_rate_model =  PrivateCarEvBasicRateModel::find($request->id);

                    }else{
                        $private_car_ev_rate_model = new PrivateCarEvBasicRateModel();
                    }

                $private_car_ev_rate_model->zone = $request->zone;
        
                $private_car_ev_rate_model->age = $request->age;
                $private_car_ev_rate_model->kw = $request->kw;

                $private_car_ev_rate_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

                if($private_car_ev_rate_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{
                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);
                }

        }

    }


    public function edit($id){

        $private_car_ev_data = PrivateCarEvBasicRateModel::find($id);

        if($private_car_ev_data){
         return response()->json(['status' => 200,'private_car_ev_data' => $private_car_ev_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $policy_model  =  PrivateCarEvBasicRateModel::find($id);

        if( $policy_model->delete()){


            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }
}
