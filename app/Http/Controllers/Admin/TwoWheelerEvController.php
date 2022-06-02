<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoWheelerEvController extends Controller
{
    
    public function index(){

        // $policies =  Policies::get();
        
        // $two_wheeler_rate_chart = TwoWheelerRateModel::select('two_wheeler_rates.*','two_wheeler_cc_tp_charges.cc as cubic','two_wheeler_cc_tp_charges.tp_one_year')->join('two_wheeler_cc_tp_charges','two_wheeler_cc_tp_charges.id','=','two_wheeler_rates.cc')->orderBy('age')->get();

        // $cc_and_tp_for_two_wheeler  =  Two_wheeler_cc_tp::get();

        return view('admin.policies.two_wheeler_ev_basic_rate' );
    }

    // public function store(Request $request){

        
    //     $validator = Validator::make($request->all(), [   
    //         'id' => "nullable|integer",
    //         'policy_id' => "required|integer",
    //         'zone' => [
    //             'required',              
    //             Rule::in(['a', 'b']),
    //         ],
    //         'age' => "required|min:0|string",
    //         'cc' => "required|string|min:0",

           
    //         'vehicle_basic_rate' => "required|numeric|min:0"            
    //     ]);

    //     if($validator->fails()){

    //         return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

    //     }else{  
    //                 if($request->id){
                            
    //                     $two_wheeler_rate_model =  TwoWheelerRateModel::find($request->id);

    //                 }else{

    //                     $two_wheeler_rate_model = new TwoWheelerRateModel();
    //                 }

    //             $two_wheeler_rate_model->policy_id = $request->policy_id;
    //             $two_wheeler_rate_model->zone = $request->zone;
        
    //             $two_wheeler_rate_model->age = $request->age;
    //             $two_wheeler_rate_model->cc = $request->cc;

    //             $two_wheeler_rate_model->vehicle_basic_rate = (float) $request->vehicle_basic_rate;
                

    //             if($two_wheeler_rate_model->save()){

    //                 return response()->json(['status' => 200 ,'message' => "Two Wheeler Rate Inserted" ]);
    //             }else{

    //                 return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

    //             }

    //     }

    // }


    // public function edit($id){

    //     $two_wheeler_one_year_data = TwoWheelerRateModel::find($id);

    //     if($two_wheeler_one_year_data){
    //      return response()->json(['status' => 200,'two_wheeler_one_year_data' => $two_wheeler_one_year_data]);
    //      }else{
    //          return response()->json(['status' => 404,'message' => " no data found"]);
    //      }
    // }

    // public function destroy($id)
    // {

    //        $policy_model  =  TwoWheelerRateModel::find($id);

    //     if( $policy_model->delete()){


    //         return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

    //     }
    // }

}
