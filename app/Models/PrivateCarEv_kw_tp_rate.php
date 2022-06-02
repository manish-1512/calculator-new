<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCarEv_kw_tp_rate extends Model
{
    use HasFactory;
    
    protected $fillable = [       
        'kw','tp_one_year','tp_three_year'
    ];
    
    protected $table = "private_car_ev_kw_tp_rates";
    protected $primaryKey ="id";
    public $timestamps =true;
}
