<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Four_wheeler_above_6_passengers_bus_tp_additional_rates;
use App\Models\Four_wheeler_up_to_6_passengers_taxi;
use App\Models\Four_wheeler_up_to_6_passengers_taxi_tp_rates;
use App\Models\GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates;
use App\Models\GoodsCarryingVehicle_public_other_then_three_wheeler;
use App\Models\GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates;
use App\Models\PrivateCar_cc_tp;
use App\Models\Three_wheeler_goods_carrying_vehicle_public;
use App\Models\Two_wheeler_cc_tp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DynamicFieldsController extends Controller
{   



    public function index(Request $request){    


//this is for testing api         
  if($request->input('apikey') == null){
			$message = "Enter Api Key.";
            
            return response()->json([
                "error",$message
            ]); die;
		
		}else{
			if($request->input('apikey') != "964912"){
				
                $message = "Enter Valid Api Key.";
                return response()->json([
                    "error",$message
                ]); die;
                
                $response = $this->errorOutput("error",$message,'');
				echo json_encode($response); die;
			}
		}

        
		if($request->input('user_id') == null){

            $message = "Enter user_id.";
            
            return response()->json([
                "error",$message
            ]); die;
        }else{
       
                $userDetails	=	DB::table('users')->where('id',$request->input('user_id'))->first();
                if($userDetails != null ){
                    if($userDetails->is_active == 0){
                        $message = "Your account is banned. Please logout and login again or contact to support.";
                        // $response = $this->errorOutput("logout",$message,'');
                        // echo json_encode($response); die;

                        return response()->json([
                            "logout",$message,''
                        ]); die;
                    }
                }else{
                    $message = "Your account is deleted. Please logout and login again.";

                    return response()->json([
                        "logout",$message,''
                    ]); die;
                    // $response = $this->errorOutput("logout",$message,'');
                    // echo json_encode($response); die;
                }

        }
	

//////////////////





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
                        "key" => "age",
                        "value" => "",
                        "name" => "Vehicle age",
                        "type" => "selectbox",
                        "options" => [
                                [
                                    "id" =>"0_to_5",
                                    "value" =>"Up to 5 Years"
                                ],
                                [
                                    "id" =>"5_to_10",
                                    "value" =>" > 5 Years < 10 Years"
                                ] ,   
                                [
                                    "id" =>"10_to_more",
                                    "value" =>"Above 10 Years "
                                ]     
                         ]         
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
                            "key" => "age",
                            "value" => "",
                            "name" => "Vehicle age",
                            "type" => "selectbox",
                            "options" => [
                                    [
                                        "id" =>"0_to_5",
                                        "value" =>"Up to 5 Years"
                                    ],
                                    [
                                        "id" =>"5_to_10",
                                        "value" =>" > 5 Years < 10 Years"
                                    ] ,   
                                    [
                                        "id" =>"10_to_more",
                                        "value" =>"Above 10 Years "
                                    ]     
                             ]         
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

        }else if(($request->id == 5) || ($request->id == 6)){

            if($request->id == 5 ){

                $weight =  GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates::select('id','kilogram as value')->get();
            }else if($request->id == 6){
                $weight =  GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates::select('id','kilogram as value')->get();
            }


            $fields = [


                       
                        [
                        "key" => "gross_vehicle_weight",
                        "value" => "",
                        "name" => "Gross Vehicle Weight",
                        "type" => "selectbox",
                        "options" =>$weight          
                        ],
                        [
                            "key" => "age",
                            "value" => "",
                            "name" => "Vehicle age",
                            "type" => "selectbox",
                            "options" => [
                                    [
                                        "id" =>"0_to_5",
                                        "value" =>"Up to 5 Years"
                                    ],
                                    [
                                        "id" =>"5_to_7",
                                        "value" =>" > 5 Years < 7 Years"
                                    ] ,   
                                    [
                                        "id" =>"7_to_more",
                                        "value" =>"Above 7 Years "
                                    ]     
                             ]         
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
                                        ],     
                                        [
                                            "id" =>"c",
                                            "value" =>"c"
                                        ]     
                                ]
                        ], 
                       
                        [
                            "key" => "geographical_ext",
                            "name" => "Geographical Ext",
                            "value" => "",
                            "type" => "textbox",
                        ],
                        [
                            "key" => "imt_23",
                            "name" => "IMT 23",
                            "value" => "",
                            "type" => "selectbox",
                            "options" =>[
                                [
                                    "id" =>"0",
                                    "value" =>"N"
                                ],
                                [
                                    "id" =>"1",
                                    "value" =>"Y"
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
                        "key" => "ll_to_employee_other_then_paid_driver",
                        "name" => "LL to Employee Other Then Paid Driver",
                        "value" => "",
                        "type" => "textbox",
                        ],
                    
        ];

            return response()->json([

                "fields" => array_merge($common_fields,$fields)
            ]);

        }else if($request->id == 7){

          $cc =   Four_wheeler_up_to_6_passengers_taxi_tp_rates::select('id','cc')->get();

            $fields = [

                [
                    "key" => "cc",
                    "value" => "",
                    "name" => "Cubic Capacity",
                    "type" => "selectbox",
                    "options" =>$cc          
                    ],
                    [
                        "key" => "age",
                        "value" => "",
                        "name" => "Vehicle age",
                        "type" => "selectbox",
                        "options" => [
                                [
                                    "id" =>"0_to_5",
                                    "value" =>"Up to 5 Years"
                                ],
                                [
                                    "id" =>"5_to_7",
                                    "value" =>" > 5 Years < 7 Years"
                                ] ,   
                                [
                                    "id" =>"7_to_more",
                                    "value" =>"Above 7 Years "
                                ]     
                         ]         
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
                    "key" => "geographical_ext",
                    "name" => "Geographical Ext",
                    "value" => "",
                    "type" => "textbox",
                ],
                [
                    "key" => "no_of_passengers",
                    "name" => "Seating Capacity",
                    "value" => "",
                    "type" => "textbox",
                ],
                [
                    "key" => "imt_23",
                    "name" => "IMT 23",
                    "value" => "",
                    "type" => "selectbox",
                    "options" =>[
                        [
                            "id" =>"0",
                            "value" =>"N"
                        ],
                        [
                            "id" =>"1",
                            "value" =>"Y"
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
            
];

    return response()->json([

        "fields" => array_merge($common_fields,$fields)
    ]);

        }else if( ($request->id == 8) || ($request->id == 9)){
            
          
          $fields = [

                  [
                    "key" => "age",
                    "value" => "",
                    "name" => "Vehicle age",
                    "type" => "selectbox",
                    "options" => [
                        [
                            "id" =>"0_to_5",
                            "value" =>"Up to 5 Years"
                        ],
                        [
                            "id" =>"5_to_7",
                            "value" =>" > 5 Years < 7 Years"
                        ] ,   
                        [
                            "id" =>"7_to_more",
                            "value" =>"Above 7 Years "
                        ] 
                     ]         
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
                              ],     
                              [
                                  "id" =>"c",
                                  "value" =>"c"
                              ]     
                                 
                      ]
              ], 
              [
                  "key" => "imt_23",
                  "name" => "IMT 23",
                  "value" => "",
                  "type" => "selectbox",
                  "options" =>[
                      [
                          "id" =>"0",
                          "value" =>"N"
                      ],
                      [
                          "id" =>"1",
                          "value" =>"Y"
                      ]     
              ]
              ],
              [
                "key" => "pa_to_paid_driver",
                "name" => "PA to Paid Driver",
                "value" => "",
                "type" => "textbox",
            ],
              

       
          
];

  return response()->json([

      "fields" => array_merge($common_fields,$fields)
  ]);
            //three wheeler pcv upto upto 6  and 17 passanger 
        }else if( ($request->id == 10) || ($request->id == 11) ){

              
          $fields = [

            [
              "key" => "age",
              "value" => "",
              "name" => "Vehicle age",
              "type" => "selectbox",
              "options" => [
                  [
                      "id" =>"0_to_5",
                      "value" =>"Up to 5 Years"
                  ],
                  [
                      "id" =>"5_to_7",
                      "value" =>" > 5 Years < 7 Years"
                  ] ,   
                  [
                      "id" =>"7_to_more",
                      "value" =>"Above 7 Years "
                  ] 
               ]         
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
                        ],     
                        [
                            "id" =>"c",
                            "value" =>"c"
                        ]     
                           
                ]
        ], 
       
        [
            "key" => "no_of_passengers",
            "name" => "Seating Capacity",
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
            "key" => "imt_23",
            "name" => "IMT 23",
            "value" => "",
            "type" => "selectbox",
            "options" =>[
                [
                    "id" =>"0",
                    "value" =>"N"
                ],
                [
                    "id" =>"1",
                    "value" =>"Y"
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
                    "key" => "restricted_tppd",
                    "name" => "Restricted TPPD",
                    "value" => "",
                    "type" => "selectbox",
                    "options" =>[
                        [
                            "id" =>"0",
                            "value" =>"N"
                        ],
                        [
                            "id" =>"1",
                            "value" =>"Y"
                        ]     
                ]
                ]
        
        

 
    
    ];

            return response()->json([

            "fields" => array_merge($common_fields,$fields)
            ]); 
            //school bus other bus 
        }else if(($request->id == 12) || ($request->id == 13)){

            $seating_capacity = Four_wheeler_above_6_passengers_bus_tp_additional_rates::select('id','passenger')->get();
                 
          $fields = [

            [
              "key" => "age",
              "value" => "",
              "name" => "Vehicle age",
              "type" => "selectbox",
              "options" => [
                  [
                      "id" =>"0_to_5",
                      "value" =>"Up to 5 Years"
                  ],
                  [
                      "id" =>"5_to_7",
                      "value" =>" > 5 Years < 7 Years"
                  ] ,   
                  [
                      "id" =>"7_to_more",
                      "value" =>"Above 7 Years "
                  ] 
               ]         
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
                        ],     
                        [
                            "id" =>"c",
                            "value" =>"c"
                        ]     
                           
                ]
        ], 
       
        [
            "key" => "seating_capacity",
            "name" => "Seating Capacity",
            "value" => "",
            "type" => "selectbox",
            "options" =>$seating_capacity
        ],
       
        [
            "key" => "imt_23",
            "name" => "IMT 23",
            "value" => "",
            "type" => "selectbox",
            "options" =>[
                [
                    "id" =>"0",
                    "value" =>"N"
                ],
                [
                    "id" =>"1",
                    "value" =>"Y"
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
            "key" => "ll_to_employee_other_then_paid_driver",
            "name" => "LL to Employee Other Then Paid Driver",
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