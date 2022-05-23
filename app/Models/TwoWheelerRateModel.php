<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoWheelerRateModel extends Model
{
 
    use HasFactory;
    protected $fillable = [       
        'policy_id','zone','age','cc','tp_one_year','vehicle_basic_rate'
    ];
    protected $table = "two_wheeler_rates";
    protected $primaryKey ="id";
    public $timestamps =true;
}
