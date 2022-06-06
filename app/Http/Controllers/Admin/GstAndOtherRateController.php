<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GstAndOtherRateModel;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GstAndOtherRateController extends Controller
{
    public function index(){

        $policies =  Policies::get();

        $gst_other_rate_data =GstAndOtherRateModel::select('gst_and_other_rates.*','policies.name as policy')->join('policies','policies.id','=','gst_and_other_rates.id')->get();

        return view('admin.gst_other_rates' ,compact('policies','gst_other_rate_data'));
    }

    public function store(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "required|integer",
            'gst_on_basic_liability' => "nullable|numeric",
            'gst_on_rest_of_other' => "nullable|numeric",
            'imt_23' => "nullable|numeric",
            'lpg_cng_percentage' => "nullable|numeric",
            'lpg_cng_additional_on_tp' => "nullable|numeric",
            'electrical_percentage' => "nullable|numeric",
          
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  

            $chech_data =  GstAndOtherRateModel::where('id',$request->id)->first();

                if ( $chech_data == null ){

                    $gst_and_other_rates_model = new GstAndOtherRateModel();
                    $gst_and_other_rates_model->id = $request->id;
                    $gst_and_other_rates_model->gst_on_basic_liability = $request->gst_on_basic_liability;
                    $gst_and_other_rates_model->gst_on_rest_of_other = $request->gst_on_rest_of_other;
                    $gst_and_other_rates_model->imt_23 = $request->imt_23;
                    $gst_and_other_rates_model->lpg_cng_percentage = $request->lpg_cng_percentage;
                    $gst_and_other_rates_model->lpg_cng_additional_on_tp = $request->lpg_cng_additional_on_tp;
                    $gst_and_other_rates_model->electrical_percentage = $request->electrical_percentage;
                  

                        if($gst_and_other_rates_model->save()){
                            return response()->json(['status' => 200 ,'message' => "Inserted" ]);

                        }else{

                            return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                        }
                }else{

                    return response()->json(['status' => 500 ,'message' => "already added for this Policy" ]);

                }
                  

                       

        }

    }
    public function update(Request $request){

        
        $validator = Validator::make($request->all(), [  

            'id' => "required|integer",
            'gst_on_basic_liability' => "nullable|numeric",
            'gst_on_rest_of_other' => "nullable|numeric",
            'imt_23' => "nullable|numeric",
            'lpg_cng_percentage' => "nullable|numeric",
            'lpg_cng_additional_on_tp' => "nullable|numeric",
            'electrical_percentage' => "nullable|numeric",
          
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{  
                    
                            
                           $gst_and_other_rates_model =  GstAndOtherRateModel::find($request->id);
                        
                            $gst_and_other_rates_model->gst_on_basic_liability = $request->gst_on_basic_liability;
                            $gst_and_other_rates_model->gst_on_rest_of_other = $request->gst_on_rest_of_other;
                            $gst_and_other_rates_model->imt_23 = $request->imt_23;
                            $gst_and_other_rates_model->lpg_cng_percentage = $request->lpg_cng_percentage;
                            $gst_and_other_rates_model->lpg_cng_additional_on_tp = $request->lpg_cng_additional_on_tp;
                            $gst_and_other_rates_model->electrical_percentage = $request->electrical_percentage;
                          

                                if($gst_and_other_rates_model->save()){

                                    return response()->json(['status' => 200 ,'message' => "Inserted" ]);
                                }else{

                                    return response()->json(['status' => 500 ,'error' => "Database error Please Try Again.." ]);

                                }

                            }

    }


    public function edit($id){

        $gst_and_other_rates_data = GstAndOtherRateModel::find($id);

        if($gst_and_other_rates_data){

         return response()->json(['status' => 200,'gst_and_other_rates_data' => $gst_and_other_rates_data]);
         
         }else{
             return response()->json(['status' => 404,'message' => " no data found"]);
         }
    }

    public function destroy($id)
    {
           $model  =  GstAndOtherRateModel::find($id);
        if( $model->delete()){


            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    }
}
