<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCarModel extends Model
{
    use HasFactory;

    protected $fillable = [       
        'policy_id','zone','age','cc','vehicle_basic_rate'
    ];
    protected $table = "private_car_rates";
    protected $primaryKey ="id";
    
    public $timestamps =true;

}
