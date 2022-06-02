<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Four_wheeler_above_6_passengers_bus_basic_rates;
use App\Models\Four_wheeler_above_6_passengers_bus_tp_additional_rates;
use App\Models\Four_wheeler_up_to_6_passengers_taxi;
use App\Models\Four_wheeler_up_to_6_passengers_taxi_tp_rates;
use App\Models\GoodsCarryingVehicle_private_other_then_three_wheeler;
use App\Models\GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates;
use App\Models\GoodsCarryingVehicle_public_other_then_three_wheeler;
use App\Models\GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates;
use App\Models\MiscSpecialVehiclesModel;
use App\Models\PrivateCar_cc_tp;
use App\Models\PrivateCarModelRate;
use App\Models\Three_wheeler_goods_carrying_vehicle_private;
use App\Models\Three_wheeler_goods_carrying_vehicle_public;
use App\Models\Three_wheeler_pcv_up_to_6_passengers;
use App\Models\Two_wheeler_cc_tp;
use App\Models\TwoWheelerRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalculatePremiumController extends Controller
{
    public function calcuatePolicyPremium(Request $request){

        $idv =  $request->idv;
        $depreciation =  $request->depreciation;
        $no_claim_bonus =  $request->no_claim_bonus;
        $year_of_manufacture =  $request->year_of_manufacture;
        $zone =  $request->zone;
        $discount_on_od_premium =  $request->discount_on_od_premium;
        $pa_to_owner_driver =  $request->pa_to_owner_driver;

        if(($request->id ==1) ||  ($request->id == 2) ){

            $validator = Validator::make($request->all(), [ 
                "age" => "required",  
                'idv' => "required|numeric",
                'depreciation' => "required|numeric",
                'discount_on_od_premium' => "required|numeric",
                "year_of_manufacture"=> "required|numeric",
                "cc" => "required",
                'accessories_value' => "required|numeric",
                'no_claim_bonus' => 'required|numeric',
                'pa_to_owner_driver' => "required|numeric",
                'll_to_paid_driver' => "required|numeric",
                'pa_to_unnamed_passenger' => "required|numeric",
                'zero_depreciation' => "required|numeric"
               
            ]);
    
            if($validator->fails()){
    
                return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);
    
            }else{
                        $age =  $request->age;
                        $cubic_capacity =  $request->cc;
                        $accessories_value =  $request->accessories_value;
                        $zero_depreciation =  $request->zero_depreciation;
                        $ll_to_paid_driver =  $request->ll_to_paid_driver;
                        $pa_to_unnamed_passenger =  $request->pa_to_unnamed_passenger;
    
                        
                        $chart  =  TwoWheelerRateModel::where('zone',$zone)->where('age',$age)->where('cc',$cubic_capacity)->first();


                                    $current_idv = $idv - ( ($idv * $depreciation) / 100);
                                    $Vehicle_basic_rate = $chart->vehicle_basic_rate;                                   
                                    $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
   
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
                                    "year_of_manufacture" => $year_of_manufacture,    
                                    "Vehicle_basic_rate" => $Vehicle_basic_rate,                           
                                    "basic_for_vehicle" => $basic_for_vehicle   ,
                                    "discount_on_od_premium" => $discount_on_od_premium,
                                    "basic_od_premium_after_discount" => $basic_od_premium_after_discount,
                                    "accessories_value" => $accessories_value ,
                                    "total_basic_premium" => $total_basic_premium,
                                    "no_claim_bonus" =>  $no_claim_bonus,
                                    "net_own_damage_premium" => $net_own_damage_premium ,
                                    "zero_depreciation" => $zero_depreciation,
                                    "total_a" => $total  ,
        
                        ];
    
                        //    $restriccted_tppd =  ( $request->restriccted_tppd)? 50 : 0;
                        $cc_tp_charges =  Two_wheeler_cc_tp::where('id',$cubic_capacity)->first();   

                        if($request->id == 1){
                            $basic_liablity = $cc_tp_charges->tp_one_year;

                        }elseif($request->id == 2){
                            $basic_liablity = $cc_tp_charges->tp_five_year;
                        }else{
                            $basic_liablity = 0;
                        }
    
                        $liablity_premium = [
    
                            "basic_liability" => $basic_liablity ,
                            "pa_owner_driver" => $pa_to_owner_driver,
                            "ll_to_paid_driver" => $ll_to_paid_driver,
                            "pa_to_unnamed_passenger" => $pa_to_unnamed_passenger  ,
                            // "restriccted_tppd" =>  $restriccted_tppd,
                            "total_b" => ($basic_liablity + $pa_to_owner_driver + $ll_to_paid_driver+ $pa_to_unnamed_passenger)
    
                        ];
    
    
                        $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                         $gst =  ( $premium_before_gst * 18  / 100);
                          $total_premium = [
    
                                    "premium_before_gst" => $premium_before_gst,                               
                                    "gst" => $gst ,
                                    "final_premium" => $premium_before_gst + $gst 
                          ]  ;
    
                            return response()->json([
                                'own_damage_premium' => $own_damage_premium,
                                'liability_premium' => $liablity_premium,
                                'total_premium' => $total_premium
    
                            ]);
    
                  }
                  //this is for car
        }elseif(($request->id == 3 ) || ($request->id == 4)){


                $validator = Validator::make($request->all(), [   
                    'idv' => "required|numeric",
                    'depreciation' => "required|numeric",
                    'discount_on_od_premium' => "required|numeric",
                    'accessories_value' => "required|numeric",
                    'age' => "required",
                    'zone' => "required",
                    'cc' => "required",
                    'electrical_accessories' => "required", 
                    'lpg_cng_kit' => "required",
       
                    'no_claim_bonus' => 'required|numeric',
                    'pa_to_owner_driver' => "required|numeric",
                    'll_to_paid_driver' => "required|numeric",
                    'pa_to_unnamed_passenger' => "required|numeric",
                ]);
        
                if($validator->fails()){
        
                    return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);
        
                }else{
                            $age_of_vehicle =  $request->age;
                            $cubic_capacity =  $request->cc;
                            $electrical_accessories =  $request->electrical_accessories;
   
                            $lpg_cng_kit = $request->lpg_cng_kit;            
                            $zero_depreciation =  $request->zero_depreciation;
                            $ll_to_paid_driver =  $request->ll_to_paid_driver;
                            $pa_to_unnamed_passenger =  $request->pa_to_unnamed_passenger;
        
                            
                            $chart  =  PrivateCarModelRate::where('zone',$zone)->where('age',$age_of_vehicle)->where('cc',$cubic_capacity)->first();

                                        $current_idv = $idv - ( ($idv * $depreciation) / 100);
        
                                        $Vehicle_basic_rate = $chart->vehicle_basic_rate;
                                        
                                        $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;

                                        $basic_od_premium_after_discount = $basic_for_vehicle - ( ($basic_for_vehicle * $discount_on_od_premium) / 100 );
        
                                        $electrical_accessories = (($electrical_accessories * 4) / 100 ) ;
        
                                        $lpg_cng_kit = ($request->lpg_cng_kit * 4 ) / 100;

                                        $total_basic_premium = $basic_od_premium_after_discount + $electrical_accessories  + $lpg_cng_kit;
        
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
        
                                        "electrical_accessories" => $electrical_accessories ,
                                     
        
                                        "cng_lpg_price" => $lpg_cng_kit,
                                        "total_basic_premium" => $total_basic_premium,
        
                                        "no_claim_bonus" =>  $no_claim_bonus,
        
                                        "net_own_damage_premium" => $net_own_damage_premium ,
                                        "total_a" => $total  ,
          
                            ];
        
                                //   $restriccted_tppd =  ( $request->restriccted_tppd == 1)? 100 : 0;
                                  $lpg_cng_liablity= $request->lpg_cng_kit != 0 ? 60 :0;

                                  $cc_tp_charges =  PrivateCar_cc_tp::where('id',$cubic_capacity)->first();   

                                  if($request->id ==3 ){
                                        $basic_liablity = $cc_tp_charges->tp_one_year;  
                                  }else if($request->id == 4){
                                    $basic_liablity = $cc_tp_charges->tp_three_year; 
                                  }else{
                                    $basic_liablity = 0; 
                                  }

        
                            $liablity_premium = [
        
                                "basic_liability" => $basic_liablity  ,
                                "pa_owner_driver" => $pa_to_owner_driver,
                                "ll_to_paid_driver" => $ll_to_paid_driver,
                                "pa_to_unnamed_passenger" => $pa_to_unnamed_passenger  ,
                                // "restriccted_tppd" =>  $restriccted_tppd,
                                "lpg_cng_kit" => $lpg_cng_liablity,
                                "total_b" => ($basic_liablity + $pa_to_owner_driver + $ll_to_paid_driver+ $pa_to_unnamed_passenger + $lpg_cng_liablity)
        
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
                      //this is for goods carriying vehicle public and private 
                }else if( ($request->id == 5 ) || ($request->id == 6)  ){

                    $validator = Validator::make($request->all(), [  

                        'idv' => "required|numeric",
                        'depreciation' => "required|numeric",
                        'age' => "required",
                        'zone' => "required",
                        'gross_vehicle_weight' => "required",
                        'discount_on_od_premium' => "required|numeric",
                        'electrical_accessories' => "required", 
                        'lpg_cng_kit' => "required",
                        'geographical_ext' => "required",         
                        'imt_23' => "required",
                        'no_claim_bonus' => 'required|numeric',
                        'pa_to_owner_driver' => "required|numeric",
                        'll_to_paid_driver' => "required|numeric",
                        'll_to_employee_other_then_paid_driver' => "required|numeric",
                        // 'zero_deprication' => "required|numeric",
                      
                        
                    ]);
            
                    if($validator->fails()){
            
                        return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);
            
                    }else{
            
                                
                                 $geographical_ext =$request->geographical_ext;             
                       
                               // $zero_depreciation =  $request->zero_depreciation;
                               
                         
                                $ll_to_employee_other_then_paid_driver = $request->ll_to_employee_other_then_paid_driver;
                                
                                      if( ($request->id) == 5 )
                                            {
                                                $chart =  GoodsCarryingVehicle_public_other_then_three_wheeler::where('zone',$request->zone)->where('age',$request->age)->first();
                                                $tp_charges =  GoodsCarryingVehicle_public_other_then_three_wheeler_tp_rates::where('id',$request->gross_vehicle_weight)->first();   

                                            }else if($request->id == 6){

                                                $chart =  GoodsCarryingVehicle_private_other_then_three_wheeler::where('zone',$request->zone)->where('age',$request->age)->first();
                                                $tp_charges =  GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates::where('id',$request->gross_vehicle_weight)->first();   
                                            }

                                             
            
                                         
                                            $gross_vehicle_weight =  $request->gross_vehicle_weight;
                                            $depreciation = $request->depreciation;
                                            $current_idv = $idv - ( ($idv * $depreciation) / 100);
            
                                            $Vehicle_basic_rate = $chart->vehicle_basic_rate;
            
                                            $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
                                            
                                            $electrical_accessories = (($request->electrical_accessories * 4) / 100 );
            
                                            $lpg_cng_kit = ($request->lpg_cng_kit * 4 ) / 100;
            
                                            $basic_od_premium = $basic_for_vehicle + $electrical_accessories + $lpg_cng_kit;
            
                                            $discount_on_od_premium = ($basic_od_premium * $request->discount_on_od_premium) /100 ;                                                                                                                                                                                          
            
                                            $basic_od_premium_after_discount = $basic_od_premium - $discount_on_od_premium ;
                                            
                                            $imt_23 = ( ( ($basic_od_premium_after_discount + $geographical_ext) * 15) /100 );
                
                                            
                                            $basic_od_before_ncb = $basic_od_premium_after_discount + $imt_23 +$geographical_ext ;
                                            
                                            $no_claim_bonus = ($basic_od_before_ncb * $request->no_claim_bonus)/100;
            
                                            $net_own_damage_premium = $basic_od_before_ncb - $no_claim_bonus ;
            
                                            $total = $net_own_damage_premium ;
            
                                //liability premium

                               
                                $basic_tp = $tp_charges->tp_rate;
            
            
                                $own_damage_premium=  [
            
                                            "idv" => $idv,
                                            "depreciation"=> $depreciation,
                                            "current_idv" => $current_idv,
            
                                            "Vehicle_basic_rate" => $Vehicle_basic_rate,
                                            
                                            "basic_for_vehicle" => $basic_for_vehicle   ,
                                            "electrical_accessories" => $electrical_accessories ,
                                       
                                            "cng_lpg_price" => $lpg_cng_kit,
                                            "basic_od_premium" => $basic_od_premium,
                                            "discount_on_od_premium" => $discount_on_od_premium,
                                            "geographical_ext" => $geographical_ext,
                                            'imt_23' => $imt_23,
            
            
                                            
                                            "basic_od_before_ncb" =>$basic_od_before_ncb,
                                            "no_claim_bonus" =>  $no_claim_bonus,
            
                                            "net_own_damage_premium" => $net_own_damage_premium ,
                                            "total_a" => $total  ,
                                           
                                            "as" => $tp_charges
            
                                ];
            
                                      $lpg_cng_liablity= $request->lpg_cng_kit != 0 ? 60 :0;
                                      $geographical_ext = $geographical_ext/4;
            
                                $liablity_premium = [
                                    "basic_liability" => $basic_tp,
                                    "pa_owner_driver" => $request->pa_to_owner_driver,
                                    "ll_to_paid_driver" => $request->ll_to_paid_driver,
                                    "ll_to_employee_other_then_paid_driver" => $ll_to_employee_other_then_paid_driver,
                                    "geographical_ext" =>  $geographical_ext ,
                          
                                    "lpg_cng_kit" => $lpg_cng_liablity,                    
                                    "total_b" => ($basic_tp + $request->pa_to_owner_driver + $request->ll_to_paid_driver + $lpg_cng_liablity + $ll_to_employee_other_then_paid_driver + $geographical_ext)
            
                                ];
            
            
                                $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                                 $gst_on_basic_tp =  ( ($basic_tp )* 12  / 100);
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

                          //this is for taxi
                }else if( $request->id == 7 ){
             
                    $validator = Validator::make($request->all(), [  

                        'idv' => "required|numeric",
                        'depreciation' => "required|numeric",
                        'age' => "required",
                        'zone' => "required",
                        'year_of_manufacture' => "required",
                        "no_of_passengers" => "required|integer",
                        'discount_on_od_premium' => "required|numeric",
                        'electrical_accessories' => "required", 
                        'cc'=> "required|integer",
                        'imt_23' => "required",
                        'no_claim_bonus' => 'required|numeric',
                        'pa_to_owner_driver' => "required|numeric",
                        'll_to_paid_driver' => "required|numeric",
                        // 'zero_deprication' => "required|numeric",
                    
                        
                    ]);

                    if($validator->fails()){

                        return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

                    }else{                    
                                    
                
                   // $zero_depreciation =  $request->zero_depreciation;
                   
             
                   
                    $taxi_basic_rate =  Four_wheeler_up_to_6_passengers_taxi::where('zone',$request->zone)->where('age',$request->age)->where('cc',$request->cc)->first();
                    $taxi_tp_rate = Four_wheeler_up_to_6_passengers_taxi_tp_rates::where('id',$request->cc)->first();


                    //od premium
                    //to be continue

                           
                                $current_idv = $idv - ( ($idv * $depreciation) / 100);

                                $Vehicle_basic_rate = $taxi_basic_rate->vehicle_basic_rate;

                                $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
                                
                                $electrical_accessories = (($request->electrical_accessories * 4) / 100 );


                                $basic_od_premium = $basic_for_vehicle + $electrical_accessories ;

                                $imt_23 = ($request->imt_23 == 1) ?  ( ( ($basic_od_premium ) * 15) /100 ) : 0;

                                $basic_od_premium_before_discount = $basic_od_premium  + $imt_23;
                                
                                $discount_on_od_premium = ($basic_od_premium_before_discount * $request->discount_on_od_premium) /100 ;
                                
                                $basic_od_before_ncb = $basic_od_premium_before_discount - $discount_on_od_premium ;
                                
                                $no_claim_bonus = ($basic_od_before_ncb * $request->no_claim_bonus)/100;

                                $net_own_damage_premium = $basic_od_before_ncb - $no_claim_bonus ;

                                $total = $net_own_damage_premium ;

                    //liability premium
                    
                    $basic_tp = $taxi_tp_rate->vehicle_tp_rate	;


                    $own_damage_premium=  [

                                "idv" => $idv,
                                "depreciation"=> $depreciation,
                                "current_idv" => $current_idv,

                                "Vehicle_basic_rate" => $Vehicle_basic_rate,
                                
                                "basic_for_vehicle" => $basic_for_vehicle   ,
                                "electrical_accessories" => $electrical_accessories ,

                                "basic_od_premium" => $basic_od_premium,
                                'imt_23' => $imt_23,

                                "basic_od_premium_before_discount" => $basic_od_premium_before_discount,
                                
                                "discount_on_od_premium" => $discount_on_od_premium,
                                "basic_od_before_ncb" =>$basic_od_before_ncb,
                                "no_claim_bonus" =>  $no_claim_bonus,

                                "net_own_damage_premium" => $net_own_damage_premium ,
                                "total_a" => $total  ,
                               
                                "as" => $taxi_tp_rate

                    ];

                        //   $restriccted_tppd =  ( $request->restriccted_tppd == 1)? 150 : 0;
                          $passenger_coverage = ($taxi_tp_rate->rate_per_passanger * $request->no_of_passengers);
                       

                    $liablity_premium = [

                        "basic_liability" => $taxi_tp_rate->tp_rate,
                        "passenger_coverage" => $passenger_coverage,
                        "pa_owner_driver" => $request->pa_to_owner_driver,
                        "ll_to_paid_driver" => $request->ll_to_paid_driver,

                        // "restriccted_tppd" =>  $restriccted_tppd,

                                               
                        "total_b" => ($taxi_tp_rate->tp_rate + $request->pa_to_owner_driver + $passenger_coverage+$request->ll_to_paid_driver )

                    ];


                    $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                  
                     $gst_18_per =  ( $premium_before_gst * 18  / 100);

                      $total_premium = [
                                "premium_before_gst" => $premium_before_gst,                                                           
                                "gst_18_per" => $gst_18_per,
                                "final_premium" => $premium_before_gst + $gst_18_per ,
                      ];

                        return response()->json([
                            'own_damage_premium' => $own_damage_premium,
                            'liability_premium' => $liablity_premium,
                            'total_premium' => $total_premium

                        ]);

              }

                //this is for three wheeler goods carrying public and private

                }else if(($request->id == 8) || ($request->id == 9)){

                    $validator = Validator::make($request->all(), [  

                        'idv' => "required|numeric",
                        'depreciation' => "required|numeric",
                        'age' => "required",
                        'zone' => "required",
                        'year_of_manufacture' => "required",
                        'discount_on_od_premium' => "required|numeric",
                        // 'electrical_accessories' => "required", 
                        // 'lpg_cng_kit' => "required",
                        'imt_23' => "required",
                        'no_claim_bonus' => 'required|numeric',
                        'pa_to_owner_driver' => "required|numeric",
                        //'ll_to_paid_driver' => "required|numeric",
                        'pa_to_paid_driver' => "required|numeric",
                        // 'zero_deprication' => "required|numeric",
                        
                    ]);
            
                    if($validator->fails()){
            
                        return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);
            
                    }else{                    
                                     
                
                               // $zero_depreciation =  $request->zero_depreciation;
                               
                         
                               if($request->id == 8){
                                   $chart =  Three_wheeler_goods_carrying_vehicle_public::where('zone',$request->zone)->where('age',$request->age)->first();

                               }else if($request->id == 9){
                                      $chart =  Three_wheeler_goods_carrying_vehicle_private::where('zone',$request->zone)->where('age',$request->age)->first();
                               }

                               
                                            $current_idv = $idv - ( ($idv * $depreciation) / 100);
            
                                            $Vehicle_basic_rate = $chart->vehicle_basic_rate;
            
                                            $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
                                            
                                            $electrical_accessories = (($request->electrical_accessories * 4) / 100 );
            
                                            $lpg_cng_kit = ($request->lpg_cng_kit * 4 ) / 100;
            
                                            $basic_od_premium = $basic_for_vehicle + $electrical_accessories + $lpg_cng_kit;

                                            $discount_on_od_premium = ($basic_od_premium * $request->discount_on_od_premium) /100 ;
                                            
                                            $basic_od_premium_after_discount = $basic_od_premium - $discount_on_od_premium ;

                                            $imt_23 = ($request->imt_23 == 1) ?  ( ( ($basic_od_premium_after_discount ) * 15) /100 ) : 0;
            
                                            
                                            
                                            $basic_od_before_ncb = $basic_od_premium_after_discount + $imt_23 ;
                                            
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
                                       
                                            "external_cng_lpg_price" => $lpg_cng_kit,
                                            "basic_od_premium" => $basic_od_premium,
                                            "discount_on_od_premium" => $discount_on_od_premium,
                                            "basic_od_premium_after_discount" => $basic_od_premium_after_discount,
                                            'imt_23' => $imt_23,
            
                           
                                            
                                            
                                            "basic_od_before_ncb" =>$basic_od_before_ncb,
                                            "no_claim_bonus" =>  $no_claim_bonus,
            
                                            "net_own_damage_premium" => $net_own_damage_premium ,
                                            "total_a" => $total  ,
                                           
                                            "as" => $chart
            
                                ];
            
                                $lpg_cng_liablity= $request->lpg_cng_kit != 0 ? 60 :0;
                                   
            
                                $liablity_premium = [
            
                                    "basic_liability" => $basic_tp,
                                    "pa_owner_driver" => $request->pa_to_owner_driver,
                                    "ll_to_paid_driver" => $request->ll_to_paid_driver,
            
                                    "lpg_cng_kit" => $lpg_cng_liablity,
                                                           
                                    "total_b" => ($basic_tp + $request->pa_to_owner_driver + $request->ll_to_paid_driver + $lpg_cng_liablity )
            
                                ];
            
            
                                $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                                 $gst_on_basic_tp =  ( ($basic_tp )* 12  / 100);
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

                          //this is for three wheeler pcv 6 and 17 passangers
                }else if(($request->id== 10) || ($request->id== 11) ){

                    

        $validator = Validator::make($request->all(), [  

            'idv' => "required|numeric",
            'depreciation' => "required|numeric",
            'age' => "required",
            'zone' => "required",
            "no_of_passengers" => "required|integer",
            'discount_on_od_premium' => "required|numeric",
            'electrical_accessories' => "required", 
            'lpg_cng_kit' => "required",           
            'imt_23' => "required",
            'no_claim_bonus' => 'required|numeric',
            'pa_to_owner_driver' => "required|numeric",
            'll_to_paid_driver' => "required|numeric",
            // 'zero_deprication' => "required|numeric",
            'restricted_tppd' => "required|between:0,1",
            
        ]);

        if($validator->fails()){

            return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

        }else{                    
                         
    
                   // $zero_depreciation =  $request->zero_depreciation;
                   
             
                   if($request->id == 10){
                       $chart =  Three_wheeler_pcv_up_to_6_passengers::where('zone',$request->zone)->where('age',$request->age)->first();
                   }else if($request->id == 11){

                    $chart =  Three_wheeler_pcv_up_to_6_passengers::where('zone',$request->zone)->where('age',$request->age)->first();
                   }
      
             
                                $current_idv = $idv - ( ($idv * $depreciation) / 100);

                                $Vehicle_basic_rate = $chart->vehicle_basic_rate;

                                $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
                                
                                $electrical_accessories = (($request->electrical_accessories * 4) / 100 );

                                $lpg_cng_kit = ($request->lpg_cng_kit * 4 ) / 100;


                                $basic_od_premium = $basic_for_vehicle + $electrical_accessories + $lpg_cng_kit;

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
                           
                                "cng_lpg_price" => $lpg_cng_kit,
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

                          $restricted_tppd =  ( $request->restricted_tppd == 1)? 150 : 0;
                          $passenger_coverage = ($chart->per_passengers_rate * $request->no_of_passengers);
                       
                          $lpg_cng_liablity= $request->lpg_cng_kit != 0 ? 60 :0;

                    $liablity_premium = [

                        "basic_liability" => $basic_tp,
                        "passenger_coverage" => $passenger_coverage,
                        "pa_owner_driver" => $request->pa_to_owner_driver,
                        "ll_to_paid_driver" => $request->ll_to_paid_driver,

                        "restricted_tppd" =>  $restricted_tppd,
                        "lpg_cng_kit" => $lpg_cng_liablity,
                                               
                        "total_b" => ($basic_tp + $request->pa_to_owner_driver + $passenger_coverage+$request->ll_to_paid_driver + $lpg_cng_liablity - $restricted_tppd )

                    ];


                    $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                  
                     $gst_18_per =  ( $premium_before_gst * 18  / 100);

                      $total_premium = [
                                "premium_before_gst" => $premium_before_gst,                                                           
                                "gst_18_per" => $gst_18_per,
                                "final_premium" => $premium_before_gst + $gst_18_per ,
                      ];

                        return response()->json([
                            'own_damage_premium' => $own_damage_premium,
                            'liability_premium' => $liablity_premium,
                            'total_premium' => $total_premium

                        ]);

              }

              //this is for school bus and other bus 

                }else if(($request->id == 12) || ($request->id == 13) ){

                    
            $validator = Validator::make($request->all(), [  

                'idv' => "required|numeric",
                'depreciation' => "required|numeric",
                'age' => "required",
                'zone' => "required",
                'year_of_manufacture' => "required",
                "seating_capacity" => "required|integer",
                "no_of_seat" => "required|integer",
                'discount_on_od_premium' => "required|numeric",
                'electrical_accessories' => "required", 
                'cc'=> "required|integer",
                'imt_23' => "required",
                'no_claim_bonus' => 'required|numeric',
                'pa_to_owner_driver' => "required|numeric",
                'll_to_paid_driver' => "required|numeric",
                'll_to_employee_other_then_paid_driver' => "required|numeric",
                
                // 'zero_deprication' => "required|numeric",
            
                
            ]);

            if($validator->fails()){

                return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);

            }else{                    
                            

                    // $zero_depreciation =  $request->zero_depreciation;
                    
                
                    
                        $bus_basic_rate =  Four_wheeler_above_6_passengers_bus_basic_rates::where('zone',$request->zone)->where('age',$request->age)->first();
                        $bus_tp_rate_additional = Four_wheeler_above_6_passengers_bus_tp_additional_rates::where('id',$request->seating_capacity)->first();



                                
                                    $current_idv = $idv - ( ($idv * $depreciation) / 100);

                                    $Vehicle_basic_rate = $bus_basic_rate->vehicle_basic_rate;

                                    $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100)  + $bus_tp_rate_additional->additional_charges ;
                                    
                                    $electrical_accessories = (($request->electrical_accessories * 4) / 100 );


                                    $basic_od_premium = $basic_for_vehicle + $electrical_accessories ;

                                    $discount_on_od_premium = ($basic_od_premium * $request->discount_on_od_premium) /100 ;
                                    $basic_od_premium_after_discount = $basic_od_premium - $discount_on_od_premium;

                                    $imt_23 = ($request->imt_23 == 1) ?  ( ( ($basic_od_premium_after_discount ) * 15) /100 ) : 0;

                            
                                    
                                    
                                    $basic_od_before_ncb = $basic_od_premium_after_discount + $imt_23 ;
                                    
                                    $no_claim_bonus = ($basic_od_before_ncb * $request->no_claim_bonus)/100;

                                    $net_own_damage_premium = round( ($basic_od_before_ncb - $no_claim_bonus) ,2);

                                    $total = $net_own_damage_premium ;

                        //for other bus 
                        if($request->id == 12){

                            $basic_liablity = $bus_tp_rate_additional->other_bus_tp	;
                            $per_passenger = $bus_tp_rate_additional->other_bus_per_person ;
                        }else if($request->id == 13){

                            $basic_liablity = $bus_tp_rate_additional->school_bus_tp	;
                            $per_passenger = $bus_tp_rate_additional->school_bus_per_person ;
                        }


                        $own_damage_premium=  [

                                    "idv" => $idv,
                                    "depreciation"=> $depreciation,
                                    "current_idv" => $current_idv,

                                    "Vehicle_basic_rate" => $Vehicle_basic_rate,
                                    
                                    "basic_for_vehicle" => $basic_for_vehicle   ,
                                    "electrical_accessories" => $electrical_accessories ,

                                    "basic_od_premium" => $basic_od_premium,
                                

                                    "basic_od_premium_after_discount" => $basic_od_premium_after_discount,
                                    
                                    "discount_on_od_premium" => $discount_on_od_premium,
                                    'imt_23' => $imt_23,
                                    "basic_od_before_ncb" =>$basic_od_before_ncb,
                                    "no_claim_bonus" =>  $no_claim_bonus,

                                    "net_own_damage_premium" => $net_own_damage_premium ,
                                    "total_a" => $total  ,
                                
                                

                        ];

                            //   $restriccted_tppd =  ( $request->restriccted_tppd == 1)? 150 : 0;
                            $passenger_coverage = ($per_passenger * $request->no_of_seat);
                        

                        $liablity_premium = [

                            "basic_liability" =>  $basic_liablity,
                            "passenger_coverage" => $passenger_coverage,
                            "pa_owner_driver" => $request->pa_to_owner_driver,
                            "ll_to_paid_driver" => $request->ll_to_paid_driver,
                            "ll_to_employee_other_then_paid_driver" => $request->ll_to_employee_other_then_paid_driver,

                            // "restriccted_tppd" =>  $restriccted_tppd,

                                                
                            "total_b" => ( $basic_liablity + $request->ll_to_employee_other_then_paid_driver + $request->pa_to_owner_driver + $passenger_coverage+$request->ll_to_paid_driver )

                        ];


                        $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                    
                        $gst_18_per =  ( $premium_before_gst * 18  / 100);

                        $total_premium = [
                                    "premium_before_gst" => $premium_before_gst,                                                           
                                    "gst_18_per" => $gst_18_per,
                                    "final_premium" => $premium_before_gst + $gst_18_per ,
                        ];

                            return response()->json([
                                'own_damage_premium' => $own_damage_premium,
                                'liability_premium' => $liablity_premium,
                                'total_premium' => $total_premium

                            ]);

                }

            //this is for misc vehicles 

                }else if($request->id == 14){

                    $validator = Validator::make($request->all(), [  
                        'idv' => "required|numeric",
                        'depreciation' => "required|numeric",
                        'year_of_manufacture' => "required",
                        'age' => "required",
                        'zone' => "required",
                        'vehicle_type' =>"required|string",
                        'discount_on_od_premium' => "required|numeric",         
                        'geographical_ext' => "required",         
                        'imt_23' => "required",
                        'no_claim_bonus' => 'required|numeric',
                        'pa_to_owner_driver' => "required|numeric",
                        'll_to_paid_driver' => "required|numeric",
                        'll_to_employee_other_then_paid_driver' => "required|numeric",
                        "ll_to_employee_other_then_paid_driver" => "required|numeric"
                        // 'zero_deprication' => "required|numeric",
                
            
                    ]);
            
                    if($validator->fails()){
            
                        return response()->json(['status' => 401 ,'error' => $validator->errors()->toArray() ]);
            
                    }else{
            
                              // $zero_depreciation =  $request->zero_depreciation;
                               
                              $chart =  MiscSpecialVehiclesModel::where('zone',$request->zone)->where('age',$request->age)->first();
                               

                                          $current_idv = $idv - ( ($idv * $depreciation) / 100);
            
                                          $Vehicle_basic_rate = $chart->vehicle_basic_rate;
            
                                          $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100) ;
                                                    
                                          $basic_od_premium = $basic_for_vehicle ;
                                                                                    
                                          $discount_on_od_premium = ($basic_od_premium * $discount_on_od_premium) /100 ;

                                          $basic_od_after_discount = $basic_od_premium - $discount_on_od_premium; 

                                          
                                          $imt_23 = ($request->imt_23 == 1) ?  ( ( ($basic_od_after_discount +$request->geographical_ext ) * 15) /100 ) : 0;

                                          $basic_od_before_ncb = $basic_od_after_discount + $imt_23 + $request->geographical_ext ;
                                          
                                          $no_claim_bonus = ($basic_od_before_ncb * $request->no_claim_bonus)/100;
            
                                          $net_own_damage_premium = $basic_od_before_ncb - $no_claim_bonus ;
            
                                          $total = $net_own_damage_premium ;
            
                              //liability premium
                              
                              $basic_tp =  ($request->vehicle_type == "agriculture") ? $chart->tp_agriculture_6hp : $chart->tp_other_misc_vehicle;
            
            
                              $own_damage_premium=  [
            
                                          "idv" => $idv,
                                          "depreciation"=> $depreciation,
                                          "current_idv" => $current_idv,
            
                                          "Vehicle_basic_rate" => $Vehicle_basic_rate,
                                          
                                          "basic_for_vehicle" => $basic_for_vehicle   ,
                                                         
                                          "basic_od_premium" => $basic_od_premium,
                                          "discount_on_od_premium" => $discount_on_od_premium,

                                         
                                          'basic_od_after_discount'=> $basic_od_after_discount,
                                            "imt_23" => $imt_23,
                                          
                                          "basic_od_before_ncb" =>$basic_od_before_ncb,
                                          "no_claim_bonus" =>  $no_claim_bonus,
            
                                          "net_own_damage_premium" => $net_own_damage_premium ,
                                          "total_a" => $total  ,
                                         
                                          "as" => $chart
            
                              ];
            
                                    $restriccted_tppd =  ( $request->restriccted_tppd == 1)? 150 : 0;
                                    $passenger_coverage = ($chart->per_passengers_rate * $request->no_of_passengers);
                                 
                                    $lpg_cng_liablity= $request->lpg_cng_kit != 0 ? 60 :0;
            
                              $liablity_premium = [
            
                                  "basic_liability" => $basic_tp,
                                  "passenger_coverage" => $passenger_coverage,
                                   "geographical_ext" => $request->geographical_ext /4, 
                                  "pa_owner_driver" => $request->pa_to_owner_driver,
                                  "ll_to_paid_driver" => $request->ll_to_paid_driver,
                                  "ll_to_employee_other_then_paid_driver" => $request->ll_to_employee_other_then_paid_driver,
            
                                
                               
                                                         
                                  "total_b" => ($basic_tp + $request->pa_to_owner_driver + $request->ll_to_employee_other_then_paid_driver + $request->geographical_ext /4 + $passenger_coverage+$request->ll_to_paid_driver   )
            
                              ];
            
            
                              $premium_before_gst=  $own_damage_premium['total_a'] + $liablity_premium['total_b'];
                            
                               $gst_18_per =  ( $premium_before_gst * 18  / 100);
            
                                $total_premium = [
                                          "premium_before_gst" => $premium_before_gst,                                                           
                                          "gst_18_per" => $gst_18_per,
                                          "final_premium" => $premium_before_gst + $gst_18_per ,
                                ];
            
                                  return response()->json([
                                      'own_damage_premium' => $own_damage_premium,
                                      'liability_premium' => $liablity_premium,
                                      'total_premium' => $total_premium
            
                                  ]);
                    
            
                    }
            
            

                }

            }

        }
    

