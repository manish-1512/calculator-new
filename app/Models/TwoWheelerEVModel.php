<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoWheelerEVModel extends Model
{
    use HasFactory;
    protected $fillable = [       
        'zone','kilowatt','vehicle_basic_rate'
    ];
    protected $table = "two_wheeler_ev_basic_rates";
    protected $primaryKey ="id";
    public $timestamps =true;
}
