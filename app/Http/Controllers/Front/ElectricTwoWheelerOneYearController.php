<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Two_wheeler_cc_tp;
use App\Models\TwoWheelerRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ElectricTwoWheelerOneYearController extends Controller
{
    public function calcuatePolicyPremiun(Request $request){


        $validator = FacadesValidator::make($request->all(), [   
            'idv' => "required|numeric",
            'depreciation' => "required|numeric",
            'discount_on_od_premium' => "required|numeric",
            'accessories_value' => "required|numeric",
            'no_claim_bonus' => 'required|numeric',
            'pa_to_owner_driver' => "required|numeric",
            'll_to_paid_driver' => "required|numeric",
            'pa_to_unnamed_passenger' => "required|numeric",
            'restriccted_tppd' => "required|between:0,1"
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{

                    $idv =  $request->idv;
                    $depreciation =  $request->depreciation;
                    $age_of_vehicle =  $request->age;
                    $cubic_capacity =  $request->cc;
                    $year_of_manufacture =  $request->year_of_manufacture;
                    $zone =  $request->zone;
                    $discount_on_od_premium =  $request->discount_on_od_premium;
                    $accessories_value =  $request->accessories_value;
                    $no_claim_bonus =  $request->no_claim_bonus;
                    $zero_depreciation =  $request->zero_depreciation;
                    $pa_to_owner_driver =  $request->pa_to_owner_driver;
                    $ll_to_paid_driver =  $request->ll_to_paid_driver;
                    $pa_to_unnamed_passenger =  $request->pa_to_unnamed_passenger;

                    
                    $chart  =  TwoWheelerRateModel::where('zone',$zone)->where('age',$age_of_vehicle)->where('cc',$cubic_capacity)->first();

                    //od premium
                         $cc_tp_charges =  Two_wheeler_cc_tp::where('id',$cubic_capacity)->first();           

                                $idv = $idv;
                                $depreciation = $depreciation;
                                $current_idv = $idv - ( ($idv * $depreciation) / 100);

                                $Vehicle_basic_rate = $chart->vehicle_basic_rate;
                                
                                $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;

                                $discount_on_od_premium = $discount_on_od_premium;

                                $basic_od_premium_after_discount = $basic_for_vehicle - ( ($basic_for_vehicle * $discount_on_od_premium) / 100 ) ;

                                $accessories_value = (($accessories_value * 4) / 100 ) ;
                                
                                $total_basic_premium = $basic_od_premium_after_discount + $accessories_value;

                                $no_claim_bonus = ($total_basic_premium * $no_claim_bonus)/100;

                                $net_own_damage_premium = $total_basic_premium - $no_claim_bonus ;
                                $total = $net_own_damage_premium ;

                    //liability premium
                    


                    $own_damage_premium=  [

                                "idv" => $idv,
                                "depreciatio"=> $depreciation,
                                "current_idv" => $current_idv,

                                "Vehicle_basic_rate" => $Vehicle_basic_rate,
                                
                                "basic_for_vehicle" => $basic_for_vehicle   ,

                                "discount_on_od_premium" => $discount_on_od_premium,

                                "basic_od_premium_after_discount" => $basic_od_premium_after_discount,

                                "accessories_value" => $accessories_value ,
                                
                                "total_basic_premium" => $total_basic_premium,

                                "no_claim_bonus" =>  $no_claim_bonus,

                                "net_own_damage_premium" => $net_own_damage_premium ,
                                "total_a" => $total  ,

                                "vehicle_basic_rate" => $chart->vehicle_basic_rate,
                                "tp_one_year" => $chart->tp_one_year,
                                "tp_five_year" => $chart->tp_five_year,
                                "as" => $cc_tp_charges

                    ];

                          $restriccted_tppd =  ( $request->restriccted_tppd)? 50 : 0;

                    $liablity_premium = [

                        "basic_liability" => $cc_tp_charges->tp_one_year  ,
                        "pa_owner_driver" => $pa_to_owner_driver,
                        "ll_to_paid_driver" => $ll_to_paid_driver,
                        "pa_to_unnamed_passenger" => $pa_to_unnamed_passenger  ,
                        "restriccted_tppd" =>  $restriccted_tppd,
                        "total_b" => ($cc_tp_charges->tp_one_year + $pa_to_owner_driver + $ll_to_paid_driver+ $pa_to_unnamed_passenger - $restriccted_tppd )

                    ];


                    $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                     $gst =  ( $premium_before_gst * 18  / 100);
                      $total_premium = [

                                "premium_before_gst" => $premium_before_gst,                               
                                "gst" => $gst ,
                                "final_premium" => $premium_before_gst + $gst 
                      ];

                        return response()->json([
                            'own_damage_premium' => $own_damage_premium,
                            'liability_premium' => $liablity_premium,
                            'total_premium' => $total_premium

                        ]);

              }
        }
}
