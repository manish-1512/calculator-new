<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Four_wheeler_above_6_passengers_bus_tp_additional_rates extends Model
{
    use HasFactory;
    protected $fillable = [       
        'passenger','additional_charges','school_bus_tp','school_bus_per_person','other_bus_tp','other_bus_per_person'
    ];
    protected $table = "four_wheeler_above_6_passengers_additional_charges_and_tp";
    protected $primaryKey ="id";
    public $timestamps =true;
}
