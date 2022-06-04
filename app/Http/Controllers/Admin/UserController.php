<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

       $users_data =    User::where('role',NULL)->select('id','name','email','phone','is_active')->get();

       return view('admin.users',compact('users_data'));
    }


    public function changeStatus($id){


        $data =  User::find($id);
  
        $status =($data['is_active'] == '1')?'0':'1';

      if(User::where('id',$id)->update(['is_active'=> $status ])){

        return   redirect()->back()->with('status_update', 'The status is updated');       

       }else{
           return   redirect()->back()->with('status_not_update', 'The status is not  updated');    
       }


    }


    public function destroy($id)
    {
           $user_model  =  User::find($id);

        if( $user_model->delete()){
            return response()->json(['status' => 200,'message' => "User Deleted"]);

        }
    }


}
