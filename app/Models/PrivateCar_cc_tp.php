<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCar_cc_tp extends Model
{
    use HasFactory;

    protected $fillable = [       
        'cc','tp_one_year','tp_three_year'
    ];
    protected $table = "private_car_cc_tp_charges";
    protected $primaryKey ="id";
    public $timestamps =true;
    
}
