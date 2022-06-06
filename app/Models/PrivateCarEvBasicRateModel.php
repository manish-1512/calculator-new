<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCarEvBasicRateModel extends Model
{
    use HasFactory;
    protected $fillable = [       
        'policy_id','zone','age','cc','vehicle_basic_rate'
    ];
    protected $table = "private_car_ev_basic_rates";
    protected $primaryKey ="id";
    
    public $timestamps =true;
}
