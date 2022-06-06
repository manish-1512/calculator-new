<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstAndOtherRateModel extends Model
{
    use HasFactory;

    protected $fillable = [       
        'id','gst_on_basic_liability','gst_on_rest_of_other','imt_23','lpg_cng_percentage','lpg_cng_additional_on_tp','electrical_percentage'
    ];
    protected $table = "gst_and_other_rates";
    protected $primaryKey ="id";
    public $timestamps =true;

}
