<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsCarryingVehicle_public_other_then_three_wheeler extends Model
{
    use HasFactory;
    
    protected $fillable = [       
        'policy_id','zone','age','vehicle_basic_rate'
    ];
    protected $table = "goods_carrying_vehicle_public_other_3_wheeler";
    protected $primaryKey ="id";
    public $timestamps =true;
}
