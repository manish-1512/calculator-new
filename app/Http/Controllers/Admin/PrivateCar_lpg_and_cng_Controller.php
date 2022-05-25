<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivateCar_cc_tp;
use App\Models\PrivateCar_lpg_cng_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PrivateCar_lpg_and_cng_Controller extends Controller
{
   
    public function index(){

    
        
        $private_car_lpg_cng_chart = PrivateCar_lpg_cng_model::select('private_car_lpg_cng_price.*','private_car_cc_tp_charges.cc as cubic')->join('private_car_cc_tp_charges','private_car_cc_tp_charges.id','=','private_car_lpg_cng_price.cc')->orderBy('age')->get();
        $cc_and_tp_for_private_car  =  PrivateCar_cc_tp::get();

        return view('admin.policies.private_car_cng_lpg_chart' ,compact('private_car_lpg_cng_chart','cc_and_tp_for_private_car'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'zone' => [
                'required',              
                Rule::in(['a', 'b']),
            ],
            'age' => "required|min:0|string",
            'cc' => "required|string|min:0",
            'price' => "required|numeric|min:0"            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $private_car_lpg_cng_model =  PrivateCar_lpg_cng_model::find($request->id);

                    }else{

                        $private_car_lpg_cng_model = new PrivateCar_lpg_cng_model();
                    }
                $private_car_lpg_cng_model->zone = $request->zone;
        
                $private_car_lpg_cng_model->age = $request->age;
                $private_car_lpg_cng_model->cc = $request->cc;

                $private_car_lpg_cng_model->price = $request->price;
                

                if($private_car_lpg_cng_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Your Action IS Done" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);
                }

        }


    }

    public function edit($id){

        $private_car_lpg_cng_data = PrivateCar_lpg_cng_model::find($id);

        if($private_car_lpg_cng_data){
         return response()->json(['status' => 200,'private_car_lpg_cng_data' => $private_car_lpg_cng_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $policy_model  =  PrivateCar_lpg_cng_model::find($id);

        if( $policy_model->delete()){


            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }
}
