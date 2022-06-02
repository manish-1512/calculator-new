<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TwoWheelerEv_kw_tp_rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TwoWheeler_kw_and_tp_Controller extends Controller

{
       public function index(){

    $two_wheeler_ev_kw_tp_data =   TwoWheelerEv_kw_tp_rate::get();

    return view('admin.policies.two_wheeler_ev_tp_rates',compact('two_wheeler_ev_kw_tp_data'));
}

public function store(Request $request){

    
    $validator = Validator::make($request->all(), [  

        'id' => "nullable|integer",
        'kw' => "required|string",
        'tp_one_year' => "required|numeric",
        'tp_five_year' => "required|numeric",         
    ]);

    if($validator->fails()){

        return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

    }else{  
                if($request->id){
                        
                    $two_wheeler_ev_kw_tp_model = TwoWheelerEv_kw_tp_rate::find($request->id);

                }else{

                    $two_wheeler_ev_kw_tp_model = new TwoWheelerEv_kw_tp_rate();
                }

                
            $two_wheeler_ev_kw_tp_model->kw = $request->kw;

            $two_wheeler_ev_kw_tp_model->tp_five_year = $request->tp_five_year;

            $two_wheeler_ev_kw_tp_model->tp_one_year =  $request->tp_one_year;
            

            if($two_wheeler_ev_kw_tp_model->save()){

                return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
            }else{

                return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

            }

    }

}


public function edit($id){

    $two_wheeler_ev_kw_tp_data =TwoWheelerEv_kw_tp_rate::find($id);

    if($two_wheeler_ev_kw_tp_data){
     return response()->json(['status' => 200,'two_wheeler_ev_kw_tp_data' => $two_wheeler_ev_kw_tp_data]);
     }else{
         return response()->json(['status' => 404,'message' => " no data found"]);
     }
}

public function destroy($id)
{

       $two_wheeler_ev_kw_tp_model  = TwoWheelerEv_kw_tp_rate::find($id);

    if( $two_wheeler_ev_kw_tp_model->delete()){
        return response()->json(['status' => 200,'message' => "deleted"]);
    }
}

}
