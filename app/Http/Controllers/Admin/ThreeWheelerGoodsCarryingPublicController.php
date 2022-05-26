<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use App\Models\Three_wheeler_goods_carrying_vehicle_public;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ThreeWheelerGoodsCarryingPublicController extends Controller
{
    public function index(){

        $policies =  Policies::get();

        $goods_carrying_data = Three_wheeler_goods_carrying_vehicle_public::get();

        return view('admin.policies.three_wheeler_goods_carrying_public' ,compact('policies','goods_carrying_data'));
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
            'vehicle_tp_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $three_wheeler_goods_carrying_public_model =  Three_wheeler_goods_carrying_vehicle_public::find($request->id);

                    }else{

                        $three_wheeler_goods_carrying_public_model = new Three_wheeler_goods_carrying_vehicle_public();
                    }

                $three_wheeler_goods_carrying_public_model->policy_id = $request->policy_id;
                $three_wheeler_goods_carrying_public_model->zone = $request->zone;
        
                $three_wheeler_goods_carrying_public_model->age = $request->age;

                $three_wheeler_goods_carrying_public_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                $three_wheeler_goods_carrying_public_model->vehicle_tp_rate =  $request->vehicle_tp_rate;
                

                if($three_wheeler_goods_carrying_public_model->save()){
                    return response()->json(['status' => 200 ,'message' => "Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $three_wheeler_goods_carrying_public_data = Three_wheeler_goods_carrying_vehicle_public::find($id);
        if($three_wheeler_goods_carrying_public_data){
         return response()->json(['status' => 200,'three_wheeler_goods_carrying_public_data' => $three_wheeler_goods_carrying_public_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  Three_wheeler_goods_carrying_vehicle_public::find($id);
        if( $model->delete()){
            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    } 
}
