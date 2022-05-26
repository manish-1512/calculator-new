<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Three_wheeler_goods_carrying_vehicle_private extends Model
{
    use HasFactory;
    protected $fillable = [       
        'policy_id','zone','age','vehicle_basic_rate','vehicle_tp_rate'
    ];
    protected $table = "three_wheeler_goods_carrying_vehicle_private";
    protected $primaryKey ="id";
    public $timestamps =true;
}
