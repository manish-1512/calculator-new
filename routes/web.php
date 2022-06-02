<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//------------------------------------------------------------------------------------------// 
Route::get('/forgot-password', function () {
    return view('admin.auth.forgot-password');
  })->middleware('guest')->name('password.request');
  
  Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
  
    $status = Password::sendResetLink(
        $request->only('email')
    );
  
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
  })->middleware('guest')->name('password.email');
  
  Route::get('/reset-password/{token}', function ($token) {
    return view('admin.auth.reset-password', ['token' => $token]);
  })->middleware('guest')->name('password.reset');
  
  
  Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
  
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
  
            $user->save();
  
            event(new PasswordReset($user));
        }
    );
  
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login_view')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
  })->middleware('guest')->name('password.update');
  
  
  
  //---------------------------------------------------------------------------------------------//
  
  Route::group(['prefix' => 'admin','middleware'=> ['guest','autoTrim','preventBackHistory'] ,'namespace' => 'App\Http\Controllers\Admin'],function(){
    Route::get('/',function (){  return view('admin.auth.login');})->name('login_view');
    Route::post('/login','Auth\LoginController@login')->name('admin.login');
 }); 


 Route::group(['prefix' => 'admin','as'=>'admin.' ,'middleware'=> ['auth','isAdmin','preventBackHistory'] ,'namespace' => 'App\Http\Controllers\Admin'],function(){
    
    Route::get('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard','DashboardController@dashboardData')->name('dashboard');

    Route::group(['prefix' => 'moter-policies','as'=>'moter_policies.'],function() {    
        Route::get('/','PoliciesController@index')->name('index');
        Route::post('/store','PoliciesController@store')->name('store');
        Route::get('/status/{id}','PoliciesController@changeStatus')->name('status');
        Route::get('/edit/{id}','PoliciesController@edit')->name('edit');
        Route::post('/update','PoliciesController@update')->name('update');
        Route::delete('/delete/{id}','PoliciesController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'two-wheeler-one-year','as'=>'two_wheeler_one_year.'],function() {   

        Route::get('/','TwoWheelerOneYearController@index')->name('index');
        Route::post('/store','TwoWheelerOneYearController@store')->name('store');
        Route::get('/edit/{id}','TwoWheelerOneYearController@edit')->name('edit');
        Route::delete('/delete/{id}','TwoWheelerOneYearController@destroy')->name('destroy');


        Route::group(['prefix' => 'cc-tp','as'=>'cc_tp.'],function() {   

            Route::get('/','TwoWheeler_cc_and_tp_Controller@index')->name('index');
            Route::post('/store','TwoWheeler_cc_and_tp_Controller@store')->name('store');
            Route::get('/edit/{id}','TwoWheeler_cc_and_tp_Controller@edit')->name('edit');
            Route::delete('/delete/{id}','TwoWheeler_cc_and_tp_Controller@destroy')->name('destroy');
            
    
        });
    });

    Route::group(['prefix' => 'private-car','as'=>'private_car.'],function() {   

        Route::get('/','PrivateCarController@index')->name('index');
        Route::post('/store','PrivateCarController@store')->name('store');
        Route::get('/edit/{id}','PrivateCarController@edit')->name('edit');
        Route::delete('/delete/{id}','PrivateCarController@destroy')->name('destroy');

        Route::group(['prefix' => 'cc-tp','as'=>'cc_tp.'],function() {   

            Route::get('/','PrivateCar_cc_and_tp_Controller@index')->name('index');
            Route::post('/store','PrivateCar_cc_and_tp_Controller@store')->name('store');
            Route::get('/edit/{id}','PrivateCar_cc_and_tp_Controller@edit')->name('edit');
            Route::delete('/delete/{id}','PrivateCar_cc_and_tp_Controller@destroy')->name('destroy');

        });

        Route::group(['prefix' => 'lpg-cng','as'=>'lpg_cng.'],function() {   

            Route::get('/','PrivateCar_lpg_and_cng_Controller@index')->name('index');
            Route::post('/store','PrivateCar_lpg_and_cng_Controller@store')->name('store');
            Route::get('/edit/{id}','PrivateCar_lpg_and_cng_Controller@edit')->name('edit');
            Route::delete('/delete/{id}','PrivateCar_lpg_and_cng_Controller@destroy')->name('destroy');

        });


    });

    Route::group(['prefix' => 'goods-carrying-public','as'=>'goods_carrying_public.'],function() {   

        Route::get('/','GoodsCarryingPublicController@index')->name('index');
        Route::post('/store','GoodsCarryingPublicController@store')->name('store');
        Route::get('/edit/{id}','GoodsCarryingPublicController@edit')->name('edit');
        Route::delete('/delete/{id}','GoodsCarryingPublicController@destroy')->name('destroy');


        Route::group(['prefix' => 'weight-tp','as'=>'weight_tp.'],function() {   

            Route::get('/','GoodsCarryingPublicTpWeightRatesController@index')->name('index');
            Route::post('/store','GoodsCarryingPublicTpWeightRatesController@store')->name('store');
            Route::get('/edit/{id}','GoodsCarryingPublicTpWeightRatesController@edit')->name('edit');
            Route::delete('/delete/{id}','GoodsCarryingPublicTpWeightRatesController@destroy')->name('destroy');

        });

    });

    Route::group(['prefix' => 'goods-carrying-private','as'=>'goods_carrying_private.'],function() {   

        Route::get('/','GoodsCarryingPrivateController@index')->name('index');
        Route::post('/store','GoodsCarryingPrivateController@store')->name('store');
        Route::get('/edit/{id}','GoodsCarryingPrivateController@edit')->name('edit');
        Route::delete('/delete/{id}','GoodsCarryingPrivateController@destroy')->name('destroy');


        Route::group(['prefix' => 'weight-tp','as'=>'weight_tp.'],function() {   

            Route::get('/','GoodsCarryingPrivateTpWeightRatesController@index')->name('index');
            Route::post('/store','GoodsCarryingPrivateTpWeightRatesController@store')->name('store');
            Route::get('/edit/{id}','GoodsCarryingPrivateTpWeightRatesController@edit')->name('edit');
            Route::delete('/delete/{id}','GoodsCarryingPrivateTpWeightRatesController@destroy')->name('destroy');

        });

    });

    Route::group(['prefix' => 'three-wheeler-goods-carrying-public','as'=>'three_wheeler_goods_carrying_public.'],function() {   

        Route::get('/','ThreeWheelerGoodsCarryingPublicController@index')->name('index');
        Route::post('/store','ThreeWheelerGoodsCarryingPublicController@store')->name('store');
        Route::get('/edit/{id}','ThreeWheelerGoodsCarryingPublicController@edit')->name('edit');
        Route::delete('/delete/{id}','ThreeWheelerGoodsCarryingPublicController@destroy')->name('destroy');
        
    });

    Route::group(['prefix' => 'three-wheeler-goods-carrying-private','as'=>'three_wheeler_goods_carrying_private.'],function() {   

        Route::get('/','ThreeWheelerGoodsCarryingPrivateController@index')->name('index');
        Route::post('/store','ThreeWheelerGoodsCarryingPrivateController@store')->name('store');
        Route::get('/edit/{id}','ThreeWheelerGoodsCarryingPrivateController@edit')->name('edit');
        Route::delete('/delete/{id}','ThreeWheelerGoodsCarryingPrivateController@destroy')->name('destroy');
        

    });

    Route::group(['prefix' => 'three-wheeler-pcv-upto-6-passengers','as'=>'three_wheeler_pcv_upto_6_passengers.'],function() {   
        Route::get('/','ThreeWheelerPCV_UpTo_6_PassengersController@index')->name('index');
        Route::post('/store','ThreeWheelerPCV_UpTo_6_PassengersController@store')->name('store');
        Route::get('/edit/{id}','ThreeWheelerPCV_UpTo_6_PassengersController@edit')->name('edit');
        Route::delete('/delete/{id}','ThreeWheelerPCV_UpTo_6_PassengersController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'three-wheeler-pcv-upto-17-passengers','as'=>'three_wheeler_pcv_upto_17_passengers.'],function() {   
        Route::get('/','ThreeWheelerPCV_UpTo_17_PassengersController@index')->name('index');
        Route::post('/store','ThreeWheelerPCV_UpTo_17_PassengersController@store')->name('store');
        Route::get('/edit/{id}','ThreeWheelerPCV_UpTo_17_PassengersController@edit')->name('edit');
        Route::delete('/delete/{id}','ThreeWheelerPCV_UpTo_17_PassengersController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'four-wheeler-upto-6-passengers-taxi','as'=>'four_wheeler_upto_6_passengers_taxi.'],function() {   
        Route::get('/','FourWheeler_UpTo_6_Passengers_Taxi_Controller@index')->name('index');
        Route::post('/store','FourWheeler_UpTo_6_Passengers_Taxi_Controller@store')->name('store');
        Route::get('/edit/{id}','FourWheeler_UpTo_6_Passengers_Taxi_Controller@edit')->name('edit');
        Route::delete('/delete/{id}','FourWheeler_UpTo_6_Passengers_Taxi_Controller@destroy')->name('destroy');


        Route::group(['prefix' => 'tp','as'=>'tp.'],function() {   
            Route::get('/','FourWheeler_UpTo_6_Passengers_Taxi_CC_TP_Controller@index')->name('index');
            Route::post('/store','FourWheeler_UpTo_6_Passengers_Taxi_CC_TP_Controller@store')->name('store');
            Route::get('/edit/{id}','FourWheeler_UpTo_6_Passengers_Taxi_CC_TP_Controller@edit')->name('edit');
            Route::delete('/delete/{id}','FourWheeler_UpTo_6_Passengers_Taxi_CC_TP_Controller@destroy')->name('destroy');

        });

    });

    Route::group(['prefix' => 'four-wheeler-above-6-passengers-bus','as'=>'four_wheeler_bus_above_6_passengers_basic_rates.'],function() {   
        Route::get('/','FourWheeler_Above_6_Passengers_Bus_Controller@index')->name('index');
        Route::post('/store','FourWheeler_Above_6_Passengers_Bus_Controller@store')->name('store');
        Route::get('/edit/{id}','FourWheeler_Above_6_Passengers_Bus_Controller@edit')->name('edit');
        Route::delete('/delete/{id}','FourWheeler_Above_6_Passengers_Bus_Controller@destroy')->name('destroy');


        Route::group(['prefix' => 'additional-tp','as'=>'additional_tp.'],function() { 

            Route::get('/','FourWheeler_Above_6_Passengers_Bus_TpController@index')->name('index');
            Route::post('/store','FourWheeler_Above_6_Passengers_Bus_TpController@store')->name('store');
            Route::get('/edit/{id}','FourWheeler_Above_6_Passengers_Bus_TpController@edit')->name('edit');
            Route::delete('/delete/{id}','FourWheeler_Above_6_Passengers_Bus_TpController@destroy')->name('destroy');

         });

    });



    Route::group(['prefix' => 'misc-special-vehicles','as'=>'misc_special_vehicles.'],function() {   
        Route::get('/','MiscSpecialVehiclesController@index')->name('index');
        Route::post('/store','MiscSpecialVehiclesController@store')->name('store');
        Route::get('/edit/{id}','MiscSpecialVehiclesController@edit')->name('edit');
        Route::delete('/delete/{id}','MiscSpecialVehiclesController@destroy')->name('destroy');
    });




    
 });


 //=======================================front end ==================//////////////

 Route::post('register', 'App\Http\Controllers\UserController@register');
 Route::post('login', 'App\Http\Controllers\UserController@login');

 Route::group(['middleware'=> ['auth','preventBackHistory'] ,'namespace' => 'App\Http\Controllers'],function(){
    
    Route::get('/logout','UserController@logout')->name('logout');

    Route::get('/dashboard',function(){
        echo "dashboard";
    })->name('dashboard');

    Route::post('/policies','Api\PoliciesController@index')->name('policies');
    Route::post('calculate-premium','Api\CalculatePremiumController@calcuatePolicyPremium');

    Route::post('dynamic-fields','Api\DynamicFieldsController@index');



    // Route::group(['prefix' => 'calculate-premium','as'=>'calculate_premium.'],function() {   

    //     Route::post('two-wheeler-one-year','Front\TwoWheelerOneYearController@calcuatePolicyPremium');
    //     //this route for same one two wheeler one year and five year for dynamic cc field
    //     Route::post('two-wheeler-cc-data','Front\TwoWheelerOneYearController@twoWheelerCcData');

    //     Route::post('two-wheeler-five-year','Front\TwoWheelerFiveYearController@calcuatePolicyPremium');

    //     // Route::post('electric-two-wheeler-one-year','Front\ElectricTwoWheelerOneYearController@calcuatePolicyPremium');
    //     // Route::post('electric-two-wheeler-five-year','Front\ElectricTwoWheelerFiveYearController@calcuatePolicyPremium');

    //     Route::post('private-car-one-year','Front\PrivateCarOneYearController@calcuatePolicyPremium');
    //     Route::post('private-car-three-year','Front\PrivateCarThreeYearController@calcuatePolicyPremium');

    //     //this route for same one four wheeler one year and three year for dynamic cc field
    //     Route::post('private-car-cc-data','Front\PrivateCarOneYearController@carCcData');

    //     Route::post('goods-carrying-public','Front\GoodsCarryingPublicController@calcuatePolicyPremium');
    //     Route::post('goods-carrying-private','Front\GoodsCarryingPrivateController@calcuatePolicyPremium');

    //     //this route for same one four wheeler one year and three year for dynamic gross_vehicle_weight field 
        
    //     Route::post('goods-carrying-public-kg-tp-rate','Front\GoodsCarryingPublicController@kgTpRate');
    //     Route::post('goods-carrying-private-kg-tp-rate','Front\GoodsCarryingPrivateController@kgTpRate');


    //     Route::post('three-wheeler-goods-carrying-public','Front\ThreeWheelerGoodsCarryingPublicController@calcuatePolicyPremium');

    //     Route::post('three-wheeler-goods-carrying-private','Front\ThreeWheelerGoodsCarryingPrivateController@calcuatePolicyPremium');

    //     Route::post('three-wheeler-pcv-upto-6-passengers','Front\ThreeWheelerPCV_Upto_6_PassangersController@calcuatePolicyPremium');
    //     Route::post('three-wheeler-pcv-upto-17-passengers','Front\ThreeWheelerPCV_Upto_17_PassangersController@calcuatePolicyPremium');

    //     Route::post('four-wheeler-upto-6-passengers-taxi','Front\FourWheeler_Upto_6_PassangersTaxiController@calcuatePolicyPremium');

    //     Route::post('four-wheeler-above-6-passengers-bus','Front\FourWheeler_Above_6_PassangersBusController@calcuatePolicyPremium');   

    //     Route::post('four-wheeler-above-6-school-bus','Front\FourWheeler_Above_6_SchoolBusController@calcuatePolicyPremium');        



    // });




    
    
});




