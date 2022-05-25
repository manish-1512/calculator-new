<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoodsCarryingPublicTpWeightRatesController extends Controller
{
    
    public function index(){
   
        $goods_carrying_public_tp_rates =   GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates::get();

        return view('admin.policies.goods_carrying_public_tp_rates' ,compact('goods_carrying_public_tp_rates'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'tp_rate' => "required|numeric",
            'kilogram' => "required|string",
                 
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $private_car_cc_tp_model =  GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates::find($request->id);

                    }else{

                        $private_car_cc_tp_model = new GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates();
                    }

                    

                $private_car_cc_tp_model->tp_rate = $request->tp_rate;

                $private_car_cc_tp_model->kilogram =  $request->kilogram;
                

                if($private_car_cc_tp_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $goods_carrying_public_tp_data = GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates::find($id);

        if($goods_carrying_public_tp_data){
         return response()->json(['status' => 200,'goods_carrying_public_tp_data' => $goods_carrying_public_tp_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $private_car_cc_tp_model  =  GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates::find($id);

        if( $private_car_cc_tp_model->delete()){


            return response()->json(['status' => 200,'message' => "deleted"]);

        }
    }
}
