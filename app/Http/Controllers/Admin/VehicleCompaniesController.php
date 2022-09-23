<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleCompaniesController extends Controller
{
    
    public function index(){

        $vehicle_company =   VehicleCompanies::orderBy('order_by')->get();


        return view('admin.vehicle_company',compact('vehicle_company'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [   
            'title' => "required|string",
            'is_active' => "required|digits_between:0,1",
            'order_by' => "required|integer",
           
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{


            
                $vehicle_company_model = new VehicleCompanies();
                

                        $vehicle_company_model->order_by = $request->order_by;
                        $vehicle_company_model->is_active = $request->is_active;
                        $vehicle_company_model->title = $request->title;
                        
                

                        if($vehicle_company_model->save()){

                            return response()->json(['status' => 200 ,'message' => "Policy image Inserted" ]);

                        }else{
                            return response()->json(['status' => 500 ,'error' => "Database error" ]);
                        }             
        } 


    }

    public function changeStatus($id){
        
        $data =  VehicleCompanies::select('is_active')->where('id',$id)->first()->toArray();

         $status =($data['is_active'] == '1')?'0':'1';

       if(VehicleCompanies::where('id',$id)->update(['is_active'=> $status ])){

         return   redirect()->back()->with('status_update', 'The status is updated');       

        }else{
            return   redirect()->back()->with('status_not_update', 'The status is not  updated');    
        }
        
    }

     
    public function edit($id)
    {           

           $vehicle_company_data = VehicleCompanies::find($id);

           if($vehicle_company_data){
            return response()->json(['status' => 200,'vehicle_company_data' => $vehicle_company_data]);
            }else{
                return response()->json(['status' => 404,'message' => " no data found"]);
            }
    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [   
            'id' => "required|integer",
            'is_active' => "required|digits_between:0,1",
            'order_by' => "required|integer",
            "title" => "required|string"
           
        ]);

        
        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{


            $policy_model = VehicleCompanies::find($request->id);


            $policy_model->is_active = $request->is_active;
            $policy_model->order_by = $request->order_by;
            $policy_model->title = $request->title;
       


                if($policy_model->save()){

                    return response()->json(['status' => 200,'message' => 'your data is updated']);
                }else{
                    return response()->json(['status' => 500 ,'error' => "your data is not updated " ]);
                }             


        }

    }

    
    public function destroy($id)
    {

           $model  =  VehicleCompanies::find($id);

        if( $model->delete()){

            return response()->json(['status' => 200,'message' => "deleted "]);

        }
    }

}
