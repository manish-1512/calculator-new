<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Four_wheeler_up_to_6_passengers_taxi_tp_rates extends Model
{
    use HasFactory;
    protected $fillable = [       
        'cc','tp_rate','rate_per_passanger'
    ];
    protected $table = "four_wheeler_upto_6_passengers_taxi_tp_rates";
    protected $primaryKey ="id";
    public $timestamps =true;
}
