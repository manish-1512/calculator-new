<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [       
        'vehicle_company_id','vehicle_model','order_by'
    ];
    protected $table = "vehicle_model";
    protected $primaryKey ="id";
    public $timestamps =true;
}
