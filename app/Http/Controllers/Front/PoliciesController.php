<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{

    public function index(){

         $policies =  Policies::where('is_active',1)->OrderBy('order','ASC')->get();

         if(!$policies->isEmpty()){

            return response()->json([
                'status' => 'success',
                'message' => 'moter policies',
                'data' =>[
                    'list' => $policies
                ]
            ]);

         }else{

            return response()->json([
                'status' => 'error',
                'message' => 'You dont have contacts',
                'data' =>[
                    
                ]
            ]);

         }


    }

}
