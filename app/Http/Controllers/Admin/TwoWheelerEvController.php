<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TwoWheelerEv_kw_tp_rate;
use App\Models\TwoWheelerEVModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TwoWheelerEvController extends Controller
{
    
    public function index(){

        
         $two_wheeler_ev_rate_chart = TwoWheelerEVModel::select('two_wheeler_ev_basic_rates.*','two_wheeler_ev_kw_tp_rates.kw as kilowatt')->join('two_wheeler_ev_kw_tp_rates','two_wheeler_ev_kw_tp_rates.id','=','two_wheeler_ev_basic_rates.kilowatt')->get();

        $kw_and_tp_for_two_wheeler_ev  = TwoWheelerEv_kw_tp_rate::get();

        return view('admin.policies.two_wheeler_ev_basic_rate',compact('kw_and_tp_for_two_wheeler_ev','two_wheeler_ev_rate_chart') );
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [   
            'id' => "nullable|integer",
            // 'policy_id' => "required|integer",
            'zone' => [
                'required',              
                Rule::in(['a', 'b']),
            ],
             'age' => "required|min:0|string",
            'kilowatt' => "required|numeric|min:0",

           
            'vehicle_basic_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $two_wheeler_ev_rate_model =  TwoWheelerEVModel::find($request->id);

                    }else{

                        $two_wheeler_ev_rate_model = new TwoWheelerEVModel();
                    }

                $two_wheeler_ev_rate_model->zone = $request->zone;
                $two_wheeler_ev_rate_model->age = $request->age;
                $two_wheeler_ev_rate_model->kilowatt = $request->kilowatt;

                $two_wheeler_ev_rate_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

                if($two_wheeler_ev_rate_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler EV  Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $two_wheeler_ev_data = TwoWheelerEVModel::find($id);

        if($two_wheeler_ev_data){
         return response()->json(['status' => 200,'two_wheeler_ev_data' => $two_wheeler_ev_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $model  =  TwoWheelerEVModel::find($id);

        if( $model->delete()){


            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }

}
