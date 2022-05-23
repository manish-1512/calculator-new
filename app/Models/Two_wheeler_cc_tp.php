<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Two_wheeler_cc_tp extends Model
{
    use HasFactory;
    protected $fillable = [       
        'cc','tp_one_year','tp_five_year'
    ];
    protected $table = "two_wheeler_cc_tp_charges";
    protected $primaryKey ="id";
    public $timestamps =true;
}

