<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Four_wheeler_up_to_6_passengers_taxi extends Model
{
    use HasFactory;
    protected $fillable = [       
        'policy_id','zone','age','cc','vehicle_basic_rate'
    ];
    protected $table = "four_wheeler_upto_6_passengers_taxi";
    protected $primaryKey ="id";
    public $timestamps =true;
}
