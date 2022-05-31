<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscSpecialVehiclesModel extends Model
{
    use HasFactory;

    protected $fillable = [       
        'policy_id','zone','age','vehicle_basic_rate','tp_other_misc_vehicle','tp_agriculture_6hp'
    ];
    protected $table = "misc_special_vehicles";
    protected $primaryKey ="id";
    public $timestamps =true;
}
