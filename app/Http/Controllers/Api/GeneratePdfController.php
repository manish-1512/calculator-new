<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class GeneratePdfController extends Controller
{


    public function index(Request $request)
    {   

        $request = json_decode(json_encode($request->all()),true);

       

        $data = [
            'data' => $request,    
        ];
        $pdf = PDF::loadView('quotation_view', $data);
     
        return $pdf->download('Quote.pdf');
    }
}
