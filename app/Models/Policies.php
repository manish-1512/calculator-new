<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    use HasFactory;

    
    protected $fillable = [       
        'name','image','is_active','order','tag'
    ];
    protected $table = "policies";
    protected $primaryKey ="id";
    public $timestamps =true;
}
