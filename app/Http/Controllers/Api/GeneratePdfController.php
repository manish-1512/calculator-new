<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VehicleCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
class GeneratePdfController extends Controller
{


    public function index(Request $request)
    {   

        $request = json_decode(json_encode($request->all()),true);

            $adviser =  User::where('id',$request['id'])->first();
            

          $vehicle_company =  VehicleCompanies::select('title')->where('id',$request->vehicle_company_id)->first();
        $request['vehicle_company'] = $vehicle_company['title'];

        $data = [
            'data' => $request,    
        ];
        $pdf = PDF::loadView('quotation_view', $data);
        
        $pdf->save(public_path('pdf/'.time().'.pdf'));

        return $pdf->download('Quote.pdf');
    }
}
