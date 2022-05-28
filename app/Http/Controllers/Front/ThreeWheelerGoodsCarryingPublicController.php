<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Three_wheeler_goods_carrying_vehicle_public;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreeWheelerGoodsCarryingPublicController extends Controller
{

    //18 % gst is verry  

    public function calcuatePolicyPremium(Request $request){


        $validator = Validator::make($request->all(), [  

            'idv' => "required|numeric",
            'depreciation' => "required|numeric",
            'age' => "required",
            'zone' => "required",
            'gross_vehicle_weight' => "required",
            'discount_on_od_premium' => "required|numeric",
            'electrical_accessories' => "required", 
            'lpg_cng_kit' => "required",
            'external_lpg_cng_kit_price'=> "required",  
           
            'imt_23' => "required",
            'no_claim_bonus' => 'required|numeric',
            'pa_to_owner_driver' => "required|numeric",
            'll_to_paid_driver' => "required|numeric",
            // 'zero_deprication' => "required|numeric",
            'restriccted_tppd' => "required|between:0,1",
            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{                    
                         
    
                   // $zero_depreciation =  $request->zero_depreciation;
                   
             
                   
                    $chart =  Three_wheeler_goods_carrying_vehicle_public::where('zone',$request->zone)->where('age',$request->age)->first();
                   
                    //od premium
                    //to be continue
                                $idv = $request->idv;
                                $zone = $request->zone;
                                $year_of_manufacture =  $request->year_of_manufacture;
                                $gross_vehicle_weight =  $request->gross_vehicle_weight;
                                $depreciation = $request->depreciation;
                                $current_idv = $idv - ( ($idv * $depreciation) / 100);

                                $Vehicle_basic_rate = $chart->vehicle_basic_rate;

                                $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
                                
                                $electrical_accessories = (($request->electrical_accessories * 4) / 100 );

                                $lpg_cng_kit = ($request->lpg_cng_kit == 1)? 60 : 0 ;  //this will ad on liblity premium

                                $external_lpg_cng_kit_price = ($request->external_lpg_cng_kit_price * 4 ) / 100;

                                $basic_od_premium = $basic_for_vehicle + $electrical_accessories + $external_lpg_cng_kit_price;

                                $imt_23 = ($request->imt_23 == 1) ?  ( ( ($basic_od_premium ) * 15) /100 ) : 0;

                                $basic_od_premium_before_discount = $basic_od_premium  + $imt_23;
                                
                                $discount_on_od_premium = ($basic_od_premium_before_discount * $request->discount_on_od_premium) /100 ;
                                
                                $basic_od_before_ncb = $basic_od_premium_before_discount - $discount_on_od_premium ;
                                
                                $no_claim_bonus = ($basic_od_before_ncb * $request->no_claim_bonus)/100;

                                $net_own_damage_premium = $basic_od_before_ncb - $no_claim_bonus ;

                                $total = $net_own_damage_premium ;

                    //liability premium
                    
                    $basic_tp = $chart->vehicle_tp_rate	;


                    $own_damage_premium=  [

                                "idv" => $idv,
                                "depreciation"=> $depreciation,
                                "current_idv" => $current_idv,

                                "Vehicle_basic_rate" => $Vehicle_basic_rate,
                                
                                "basic_for_vehicle" => $basic_for_vehicle   ,
                                "electrical_accessories" => $electrical_accessories ,
                           
                                "external_cng_lpg_price" => $external_lpg_cng_kit_price,
                                "basic_od_premium" => $basic_od_premium,
                                'imt_23' => $imt_23,

                                "basic_od_premium_before_discount" => $basic_od_premium_before_discount,
                                
                                "discount_on_od_premium" => $discount_on_od_premium,
                                "basic_od_before_ncb" =>$basic_od_before_ncb,
                                "no_claim_bonus" =>  $no_claim_bonus,

                                "net_own_damage_premium" => $net_own_damage_premium ,
                                "total_a" => $total  ,
                               
                                "as" => $chart

                    ];

                          $restriccted_tppd =  ( $request->restriccted_tppd == 1)? 150 : 0;
                       

                    $liablity_premium = [

                        "basic_liability" => $basic_tp,
                        "pa_owner_driver" => $request->pa_to_owner_driver,
                        "ll_to_paid_driver" => $request->ll_to_paid_driver,

                        "restriccted_tppd" =>  $restriccted_tppd,
                        "lpg_cng_kit" => $lpg_cng_kit,
                                               
                        "total_b" => ($basic_tp + $request->pa_to_owner_driver + $request->ll_to_paid_driver + $lpg_cng_kit - $restriccted_tppd )

                    ];


                    $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                     $gst_on_basic_tp =  ( ($basic_tp - $restriccted_tppd )* 12  / 100);
                     $gst_on_rest_others =  ( $net_own_damage_premium * 18  / 100);

                      $total_premium = [

                                "premium_before_gst" => $premium_before_gst,                               
                                "gst_12_per_on_basic_tp_liablity" => $gst_on_basic_tp ,
                                "gst_18_per_rest_of_other" => $gst_on_rest_others ,
                                "final_premium" => $premium_before_gst + $gst_on_basic_tp + $gst_on_rest_others,
                      ];

                        return response()->json([
                            'own_damage_premium' => $own_damage_premium,
                            'liability_premium' => $liablity_premium,
                            'total_premium' => $total_premium

                        ]);

              }
        } 
}
