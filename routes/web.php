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


    Route::group(['prefix' => 'calculate-premium','as'=>'calculate_premium.'],function() {   

        Route::post('two-wheeler-one-year','Front\TwoWheelerOneYearController@calcuatePolicyPremiun');

    });




    Route::get('/policies','Front\PoliciesController@index')->name('policies');
    
});




