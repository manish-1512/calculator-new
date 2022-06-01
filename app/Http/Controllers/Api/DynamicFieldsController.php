<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivateCar_cc_tp;
use App\Models\Two_wheeler_cc_tp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DynamicFieldsController extends Controller
{
    public function index(Request $request){

        $validator = Validator::make($request->all(), [  

            'id' => "required|numeric",
            
        ]);
        if($validator->fails()){
    
            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{

        $common_fields = [

            [
                "key" => "idv",
                "name" => "Idv",
                "value" => "",
                "type" => "textbox",

            ],
            [
                "key" => "depreciation",
                "name" => "Depreciation (%)",
                "value" => "",
                "type" => "textbox",
            ],
             [
                "key" => "year_of_manufacture",
                "name" => "Year Of Manufacture",
                "value" => "",
                "type" => "textbox",
            ],
            [
                "key" => "no_claim_bonus",
                "name" => "No Claim Bonus (%) ",
                "value" => "",
                "type" => "textbox",
            ],
            [
                "key" => "discount_on_od_premium",
                "name" => "Discount On OD Premium (%)",
                "value" => "",
                "type" => "textbox",
            ],
            [
                "key" => "pa_to_owner_driver",
                "name" => "PA to Owner Driver ",
                "value" => "",
                "type" => "textbox",
            ],
           

        ];

        if( ($request->id == 1)  || ($request->id == 2)){

            $cc =  Two_wheeler_cc_tp::select('id','cc as value')->get();


            $fields = [

                        [
                        "key" => "accessories_value",
                        "name" => "Accessories Value",
                        "value" => "",
                        "type" => "textbox",
                        ],

                        [
                        "key" => "cc",
                        "value" => "",
                        "name" => "Cubic Capacity",
                        "type" => "selectbox",
                        "options" =>$cc          
                        ],

                        [
                        "key" => "zone",
                        "value" => "",
                         "name" => "Zone",
                        "type" => "selectbox",
                        "options" =>[
                                        [
                                            "id" =>"a",
                                            "value" =>"a"
                                        ],
                                        [
                                            "id" =>"b",
                                            "value" =>"b"
                                        ]     
                                ]
                        ], 
                    [
                        "key" => "ll_to_paid_driver",
                        "name" => "LL To Paid Driver",
                        "value" => "",
                        "type" => "selectbox",
                        "options" =>[
                            [
                                "id" =>"0",
                                "value" =>"0"
                            ],
                            [
                                "id" =>"50",
                                "value" =>"50"
                            ]     
                    ]
                    ],
                    [
                        "key" => "pa_to_unnamed_passenger",
                        "name" => "PA  To UnNamed Passenger",
                        "value" => "",
                        "type" => "textbox",
                        ],
                    [
                        "key" => "zero_depreciation",
                        "name" => "Zero Depreciation",
                        "value" => "",
                        "type" => "textbox",
                        ],

        ];

            return response()->json([

                "fields" => array_merge($common_fields,$fields)
            ]);

         //this is for car    

        }else if(($request->id == 3) || ($request->id == 4)){

            $cc =  PrivateCar_cc_tp::select('id','cc as value')->get();


            $fields = [

                       
                        [
                        "key" => "cc",
                        "value" => "",
                        "name" => "Cubic Capacity",
                        "type" => "selectbox",
                        "options" =>$cc          
                        ],

                        [
                        "key" => "zone",
                        "value" => "",
                         "name" => "Zone",
                        "type" => "selectbox",
                        "options" =>[
                                        [
                                            "id" =>"a",
                                            "value" =>"a"
                                        ],
                                        [
                                            "id" =>"b",
                                            "value" =>"b"
                                        ]     
                                ]
                        ], 

                        [
                            "key" => "electrical_accessories",
                            "name" => "Electrical/Electronic Fitting",
                            "value" => "",
                            "type" => "textbox",
                        ],
                        [
                            "key" => "lpg_cng_kit",
                            "name" => "CNG/LPG Fule Kit ",
                            "value" => "",
                            "type" => "textbox",
                        ],

                    [
                        "key" => "ll_to_paid_driver",
                        "name" => "LL To Paid Driver",
                        "value" => "",
                        "type" => "selectbox",
                        "options" =>[
                            [
                                "id" =>"0",
                                "value" =>"0"
                            ],
                            [
                                "id" =>"50",
                                "value" =>"50"
                            ]     
                    ]
                    ],
                    [
                        "key" => "pa_to_unnamed_passenger",
                        "name" => "PA  To UnNamed Passenger",
                        "value" => "",
                        "type" => "textbox",
                        ],
                    [
                        "key" => "zero_depreciation",
                        "name" => "Zero Depreciation",
                        "value" => "",
                        "type" => "textbox",
                        ],

        ];

            return response()->json([

                "fields" => array_merge($common_fields,$fields)
            ]);

        }

     }
    }
}