<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleCompanies;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleModelController extends Controller
{
      
    public function index(){

        $vehicle_model =   VehicleModel::orderBy('order_by')->get();
        $vehicle_companies = VehicleCompanies::get();

        return view('admin.vehicle_model',compact('vehicle_model','vehicle_companies'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [   

            'vehicle_company_id' => "required|integer",
            'vehicle_model' => "required|string",
    
            'order_by' => "required|integer",
           
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{


            
                $vehicle_company_model = new VehicleModel();
                

                        $vehicle_company_model->order_by = $request->order_by;
                        $vehicle_company_model->vehicle_company_id = $request->vehicle_company_id;
      
                        $vehicle_company_model->vehicle_model = $request->vehicle_model;
                        
                        if($vehicle_company_model->save()){

                            return response()->json(['status' => 200 ,'message' => "Inserted" ]);

                        }else{
                            return response()->json(['status' => 500 ,'error' => "Database error" ]);
                        }             
        } 


    }

    // public function changeStatus($id){
        
    //     $data =  VehicleModel::select('is_active')->where('id',$id)->first()->toArray();

    //      $status =($data['is_active'] == '1')?'0':'1';

    //    if(VehicleModel::where('id',$id)->update(['is_active'=> $status ])){

    //      return   redirect()->back()->with('status_update', 'The status is updated');       

    //     }else{
    //         return   redirect()->back()->with('status_not_update', 'The status is not  updated');    
    //     }
        
    // }

     
    public function edit($id)
    {           

           $vehicle_model_data = VehicleModel::find($id);

           if($vehicle_model_data){
            return response()->json(['status' => 200,'vehicle_model_data' => $vehicle_model_data]);
            }else{
                return response()->json(['status' => 404,'message' => " no data found"]);
            }
    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [   
            'vehicle_company_id' => "required|integer",
            'vehicle_model' => "required|string",
    
            'order_by' => "required|integer",
        ]);

        
        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{


            $vehicle_company_model = VehicleModel::find($request->id);


                  $vehicle_company_model->order_by = $request->order_by;
                        $vehicle_company_model->vehicle_company_id = $request->vehicle_company_id;
             
                        $vehicle_company_model->vehicle_model = $request->vehicle_model;
       


                if($vehicle_company_model->save()){

                    return response()->json(['status' => 200,'message' => 'your data is updated']);
                }else{
                    return response()->json(['status' => 500 ,'error' => "your data is not updated " ]);
                }             


        }

    }

    
    public function destroy($id)
    {

           $model  =  VehicleModel::find($id);

        if( $model->delete()){

            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    }

}
