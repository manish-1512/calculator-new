<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Two_wheeler_cc_tp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TwoWheeler_cc_and_tp_Controller extends Controller
{
     
    public function index(){
   
        $two_wheeler_cc_tp_charges =  Two_wheeler_cc_tp::get();

        return view('admin.policies.two_wheeler_cc_tp_charges' ,compact('two_wheeler_cc_tp_charges'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "nullable|integer",
            'cc' => "required|string",
            'tp_one_year' => "required|numeric",
            'tp_five_year' => "required|numeric",         
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    if($request->id){
                            
                        $two_wheeler_cc_tp_model = Two_wheeler_cc_tp::find($request->id);

                    }else{

                        $two_wheeler_cc_tp_model = new Two_wheeler_cc_tp();
                    }

                    
                $two_wheeler_cc_tp_model->cc = $request->cc;

                $two_wheeler_cc_tp_model->tp_five_year = $request->tp_five_year;

                $two_wheeler_cc_tp_model->tp_one_year =  $request->tp_one_year;
                

                if($two_wheeler_cc_tp_model->save()){

                    return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
                }else{

                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                }

        }

    }


    public function edit($id){

        $two_wheeler_cc_tp_data =Two_wheeler_cc_tp::find($id);

        if($two_wheeler_cc_tp_data){
         return response()->json(['status' => 200,'two_wheeler_cc_tp_data' => $two_wheeler_cc_tp_data]);
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {

           $two_wheeler_cc_tp_model  = Two_wheeler_cc_tp::find($id);

        if( $two_wheeler_cc_tp_model->delete()){
            return response()->json(['status' => 200,'message' => "deleted"]);
        }
    }
}
