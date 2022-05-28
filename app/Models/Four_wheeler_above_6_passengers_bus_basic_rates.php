<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Four_wheeler_above_6_passengers_bus_basic_rates extends Model
{
    use HasFactory;
    protected $fillable = [       
        'policy_id','zone','age','vehicle_basic_rate'
    ];
    protected $table = "four_wheeler_above_6_passengers";
    protected $primaryKey ="id";
    public $timestamps =true;
}
