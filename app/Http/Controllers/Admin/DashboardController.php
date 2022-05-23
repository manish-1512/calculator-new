<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\DailyMilkEntryModel;
use App\Models\InqueryModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardData(){ 

            return view('admin.dashboard');
    }
}
