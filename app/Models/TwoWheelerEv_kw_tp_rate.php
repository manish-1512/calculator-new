<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoWheelerEv_kw_tp_rate extends Model
{
    use HasFactory;

    protected $fillable = [       
        'kw','tp_one_year','tp_five_year'
    ];
    
    protected $table = "two_wheeler_ev_kw_tp_rates";
    protected $primaryKey ="id";
    public $timestamps =true;
}
