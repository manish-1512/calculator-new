<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsCarryingVehicle_private_other_then_three_wheeler_tp_rates extends Model
{
    use HasFactory;
    protected $fillable = [       
        'kilogram','tp_rate'
    ];
    protected $table = "goods_carrying_vehicle_private_other_3_wheeler_tp_rates";
    protected $primaryKey ="id";
    public $timestamps =true;
}
