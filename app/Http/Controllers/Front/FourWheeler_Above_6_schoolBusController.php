<?php

namespace App\Http\Controllers\Front;
use App\Models\Four_wheeler_above_6_passengers_bus_basic_rates;
use App\Models\Four_wheeler_above_6_passengers_bus_tp_additional_rates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FourWheeler_Above_6_schoolBusController extends Controller
{
    
     

 public function calcuatePolicyPremium(Request $request){


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
            

                            $idv = $request->idv;
                            $zone = $request->zone;
                            $year_of_manufacture =  $request->year_of_manufacture;
                      
                            $depreciation = $request->depreciation;
                            $current_idv = $idv - ( ($idv * $depreciation) / 100);

                            $Vehicle_basic_rate = $bus_basic_rate->vehicle_basic_rate;

                            $basic_for_vehicle = ( ($current_idv * $Vehicle_basic_rate) / 100)  + $bus_tp_rate_additional->additional_charges ;
                            
                            $electrical_accessories = (($request->electrical_accessories * 4) / 100 );


                            $basic_od_premium = $basic_for_vehicle + $electrical_accessories ;

                            $imt_23 = ($request->imt_23 == 1) ?  ( ( ($basic_od_premium ) * 15) /100 ) : 0;

                            $basic_od_premium_before_discount = $basic_od_premium  + $imt_23;
                            
                            $discount_on_od_premium = ($basic_od_premium_before_discount * $request->discount_on_od_premium) /100 ;
                            
                            $basic_od_before_ncb = $basic_od_premium_before_discount - $discount_on_od_premium ;
                            
                            $no_claim_bonus = ($basic_od_before_ncb * $request->no_claim_bonus)/100;

                            $net_own_damage_premium = round( ($basic_od_before_ncb - $no_claim_bonus) ,2);

                            $total = $net_own_damage_premium ;

                //liability premium
                
                $basic_tp = $bus_tp_rate_additional->school_bus_tp	;


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
                           
                            "as" => $bus_tp_rate_additional

                ];

                    //   $restriccted_tppd =  ( $request->restriccted_tppd == 1)? 150 : 0;
                      $passenger_coverage = ($bus_tp_rate_additional->school_bus_per_person * $request->no_of_seat);
                   

                $liablity_premium = [

                    "basic_liability" => $bus_tp_rate_additional->school_bus_tp,
                    "passenger_coverage" => $passenger_coverage,
                    "pa_owner_driver" => $request->pa_to_owner_driver,
                    "ll_to_paid_driver" => $request->ll_to_paid_driver,
                    "ll_to_employee_other_then_paid_driver" => $request->ll_to_employee_other_then_paid_driver,

                    // "restriccted_tppd" =>  $restriccted_tppd,

                                           
                    "total_b" => ($bus_tp_rate_additional->school_bus_tp + $request->ll_to_employee_other_then_paid_driver + $request->pa_to_owner_driver + $passenger_coverage+$request->ll_to_paid_driver )

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
