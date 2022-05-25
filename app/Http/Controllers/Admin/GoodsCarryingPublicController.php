<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoodsCarryingVehicle_public_other_then_three_wheeler;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GoodsCarryingPublicController extends Controller
{
     
    public function index(){

        $policies =  Policies::get();

        $goods_carrying_data = GoodsCarryingVehicle_public_other_then_three_wheeler::get();

        return view('admin.policies.goods_carrying_public' ,compact('policies','goods_carrying_data'));
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
               
            'vehicle_basic_rate' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $goods_carrying_public_model =  GoodsCarryingVehicle_public_other_then_three_wheeler::find($request->id);

                    }else{

                        $goods_carrying_public_model = new GoodsCarryingVehicle_public_other_then_three_wheeler();
                    }

                $goods_carrying_public_model->policy_id = $request->policy_id;
                $goods_carrying_public_model->zone = $request->zone;
        
                $goods_carrying_public_model->age = $request->age;

                $goods_carrying_public_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

                if($goods_carrying_public_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $goods_carrying_public_data = GoodsCarryingVehicle_public_other_then_three_wheeler::find($id);

        if($goods_carrying_public_data){
         return response()->json(['status' => 200,'goods_carrying_public_data' => $goods_carrying_public_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  GoodsCarryingVehicle_public_other_then_three_wheeler::find($id);
        if( $model->delete()){


            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    }
}
