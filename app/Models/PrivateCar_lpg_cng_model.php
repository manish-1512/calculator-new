<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCar_lpg_cng_model extends Model
{
    use HasFactory;

    protected $fillable = [       
        'policy_id','zone','age','cc','price'
    ];
    protected $table = "private_car_lpg_cng_price";
    protected $primaryKey ="id";
    
    public $timestamps =true;
}
