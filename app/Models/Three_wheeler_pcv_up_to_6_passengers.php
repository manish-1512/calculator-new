<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Three_wheeler_pcv_up_to_6_passengers extends Model
{
    use HasFactory;

    protected $fillable = [       
        'policy_id','zone','age','vehicle_basic_rate','vehicle_tp_rate','per_passengers_rate'
    ];
    protected $table = "three_wheeler_pcu_upto_6_passengers";
    protected $primaryKey ="id";
    public $timestamps =true;
}
