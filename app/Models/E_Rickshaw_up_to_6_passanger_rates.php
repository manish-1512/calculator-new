<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class E_Rickshaw_up_to_6_passanger_rates extends Model
{
    use HasFactory;

    protected $fillable = [       
        'policy_id','zone','age','vehicle_basic_rate'
    ];
    protected $table = "e_rickshaw_up_to_6_passanger_rates";
    protected $primaryKey ="id";
    public $timestamps =true;

}
