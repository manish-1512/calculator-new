<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoodsCarryingPrivateTpWeightRatesController extends Controller
{
    public function index(){
   
        $goods_carrying_private_tp_rates =   GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates::get();

        return view('admin.policies.goods_carrying_private_tp_rates' ,compact('goods_carrying_private_tp_rates'));
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
                            
                        $goods_carrying_private_cc_tp_model =  GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates::find($request->id);

                    }else{

                        $goods_carrying_private_cc_tp_model = new GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates();
                    }

                    

                $goods_carrying_private_cc_tp_model->tp_rate = $request->tp_rate;

                $goods_carrying_private_cc_tp_model->kilogram =  $request->kilogram;
                

                if($goods_carrying_private_cc_tp_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $goods_carrying_private_tp_data = GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates::find($id);

        if($goods_carrying_private_tp_data){
         return response()->json(['status' => 200,'goods_carrying_private_tp_data' => $goods_carrying_private_tp_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $goods_carrying_private_cc_tp_model  =  GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates::find($id);

        if( $goods_carrying_private_cc_tp_model->delete()){


            return response()->json(['status' => 200,'message' => "deleted"]);

        }
    }
}
