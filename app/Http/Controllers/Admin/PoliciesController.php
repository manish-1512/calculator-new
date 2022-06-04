<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use App\Models\TwoWheelerRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoliciesController extends Controller
{


    public function index(){

        $policy_data =   Policies::orderBy('order')->get();


        return view('admin.policies.index',compact('policy_data'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [   
            'name' => "required|string",
            'is_active' => "required|digits_between:0,1",
            'order' => "required|integer",
            'tag' => "sometimes|string",
            'image' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{


            
                $policy_model = new Policies();
                

                        $policy_model->order = $request->order;
                        $policy_model->is_active = $request->is_active;
                        $policy_model->name = $request->name;
                        
                        $policy_model->tag = $request->tag;
                        
                        
                        if($request->hasFile('image')){

                            $image =  $request->file('image');
                            $extension = $image->getClientOriginalExtension();
                            $file_name = 'policy-'.time().'.'.$extension;

                            $image->move(POLICIES_IMAGES_URL,$file_name);

                            $policy_model->image = $file_name;


                        }

                        if($policy_model->save()){

                            return response()->json(['status' => 200 ,'message' => "Policy image Inserted" ]);

                        }else{
                            return response()->json(['status' => 500 ,'error' => "Database error" ]);
                        }             
        } 


    }

    public function changeStatus($id){
        
        $data =  Policies::select('is_active')->where('id',$id)->first()->toArray();

         $status =($data['is_active'] == '1')?'0':'1';

       if(Policies::where('id',$id)->update(['is_active'=> $status ])){

         return   redirect()->back()->with('status_update', 'The status is updated');       

        }else{
            return   redirect()->back()->with('status_not_update', 'The status is not  updated');    
        }
        
    }

     
    public function edit($id)
    {           

           $policy_data = Policies::find($id);

           if($policy_data){
            return response()->json(['status' => 200,'policy_data' => $policy_data]);
            }else{
                return response()->json(['status' => 404,'message' => " no data found"]);
            }
    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [   
            'id' => "required|integer",
            'is_active' => "required|digits_between:0,1",
            'order' => "required|integer",
            'tag' => "sometimes|string",
            'image' => 'sometimes|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        
        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{


            $policy_model = Policies::find($request->id);

             $old_image_name = $policy_model->image;

            $policy_model->is_active = $request->is_active;
            $policy_model->order = $request->order;
            $policy_model->name = $request->name;
            $policy_model->tag = $request->tag;

            
            if($request->hasFile('image')){
        
                $image =  $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $file_name = 'policy-'.time().'.'.$extension;
                $image->move(POLICIES_IMAGES_URL,$file_name);


                $policy_model->image = $file_name;


                            //file unlink code 
                            
                                if(file_exists(public_path(POLICIES_IMAGES_URL.$old_image_name))){

                                    unlink (public_path(POLICIES_IMAGES_URL.$old_image_name));
                                }

                }

                if($policy_model->save()){

                    return response()->json(['status' => 200,'message' => 'your data is updated']);
                }else{
                    return response()->json(['status' => 500 ,'error' => "your data is not updated " ]);
                }             


        }

    }

    
    public function destroy($id)
    {

           $policy_model  =  Policies::find($id);

           $old_image_name = $policy_model->image;

        if( $policy_model->delete()){

            if(file_exists(public_path(POLICIES_IMAGES_URL.$old_image_name))){
                unlink (public_path(POLICIES_IMAGES_URL.$old_image_name));
            }

            return response()->json(['status' => 200,'message' => "deleted Gallery Image"]);

        }
    }

}
