<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendEmailController;
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
    // $token = csrf_token();
    // dd($token);
     // dd(app());
  
   return redirect('login');

    
});
Route::get('/logout', function () {
    Auth::logout();

    return redirect('login');

    
});
///////////////////front/////////
Route::get('/', 'InsuranceController@index');



////////////////////////////////
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');



Route::get('/dashboard', 'App\Http\Controllers\Backend\PagesController@index')->name('dashboard')->middleware('auth');

// Route::group(['middleware' => ['auth']], function() {
//     /**
//     * Logout Route
//     */
//     Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');
//  });

Auth::routes();




Route::get('/participant/password', 'App\Http\Controllers\Backend\ParticipantController@passchange')->name('password.change')->middleware('auth');

Route::get('/participant/setpermission/{id}', 'App\Http\Controllers\Backend\ParticipantController@setpermission')->name('participant.setpermission')->middleware('auth');

Route::get('/rolelist', 'App\Http\Controllers\Backend\ParticipantController@rolelist')->name('participant.rolelist')->middleware('auth');



Route::post('/participant/password_update', 'App\Http\Controllers\Backend\ParticipantController@password_update')->name('password.changepassword')->middleware('auth');




// Participant Urls
Route::get('/participant', 'App\Http\Controllers\Backend\ParticipantController@index')->name('participant.index')->middleware('admincheck');
Route::post('/participant/store', 'App\Http\Controllers\Backend\ParticipantController@store')->name('participant.store')->middleware('auth');


Route::post('/participant/update/{id}', 'App\Http\Controllers\Backend\ParticipantController@update')->name('participant.update')->middleware('auth');
Route::post('/participant/password/{id}', 'App\Http\Controllers\Backend\ParticipantController@pass_update')->name('participant.pass_update')->middleware('auth');

Route::post('/participant/delete/{id}', 'App\Http\Controllers\Backend\ParticipantController@delete')->name('participant.delete')->middleware('auth');

Route::post('/permission/delete/{id}', 'App\Http\Controllers\Backend\ParticipantController@deletepermission')->name('permission.delete')->middleware('auth');

Route::post('/participant/store/{id}', 'App\Http\Controllers\Backend\ParticipantController@setroles')->name('participant.setrole')->middleware('auth');




Route::get('/reportall', 'App\Http\Controllers\Backend\ModuleController@viewreport')->name('view.report')->middleware('auth');

Route::post('/reportview', 'App\Http\Controllers\Backend\ModuleController@reportview')->name('report.view')->middleware('auth');




Route::get('/send-email/{emailid}', [SendEmailController::class, 'index'])->name('send.mail')->middleware('auth');



// Items Urls
Route::get('/item/entry', 'App\Http\Controllers\ItemController@index')->name('item.entry')->middleware('auth');

Route::get('/details/view', 'App\Http\Controllers\ItemController@viewdetails')->name('view.details')->middleware('auth');

Route::post('/item/store', 'App\Http\Controllers\ItemController@store')->name('item.store')->middleware('auth');
Route::post('/item/update/{id}', 'App\Http\Controllers\ItemController@update')->name('item.update')->middleware('auth');



Route::get('/road/entry', 'App\Http\Controllers\RoadController@index')->name('road.entry')->middleware('auth');

Route::post('/road/store', 'App\Http\Controllers\RoadController@store')->name('road.store')->middleware('auth');

Route::post('/road/update/{id}', 'App\Http\Controllers\RoadController@update')->name('road.update')->middleware('auth');



Route::get('/vehicledriver/entry', 'App\Http\Controllers\VehicleDriverController@index')->name('vehicledriver.entry')->middleware('auth');
Route::post('/vehicledriver/store', 'App\Http\Controllers\VehicleDriverController@store')->name('vehicledriver.store')->middleware('auth');

Route::post('/vehicledriver/update/{id}', 'App\Http\Controllers\VehicleDriverController@update')->name('vehicledriver.update')->middleware('auth');

Route::post('/vehicledriver/filter', 'App\Http\Controllers\VehicleDriverController@filtering')->name('vehicledriver.filtering')->middleware('auth');





Route::get('/vehicleroutemap/entry', 'App\Http\Controllers\VehicleroutemapController@index')->name('vehicleroutemap.entry')->middleware('auth');

Route::post('/vehicleroutemap/store', 'App\Http\Controllers\VehicleroutemapController@store')->name('vehicleroutemap.store')->middleware('auth');

Route::post('/vehicleroutemap/update/{id}', 'App\Http\Controllers\VehicleroutemapController@update')->name('vehicleroutemap.update')->middleware('auth');

Route::post('/vehicleroutemap/filter', 'App\Http\Controllers\VehicleroutemapController@filtering')->name('vehicleroutemap.filter')->middleware('auth');



Route::get('/vehicleroutetime/entry', 'App\Http\Controllers\vehicleroutetimecontroller@index')->name('vehicleroutetime.entry')->middleware('auth');

Route::post('/vehicleroutetime/store', 'App\Http\Controllers\vehicleroutetimecontroller@store')->name('vehicleroutetime.store')->middleware('auth');

Route::get('/fuelgas/entry', 'App\Http\Controllers\FuelgasController@index')->name('fuelgas.entry')->middleware('auth');
Route::post('/fuelgas/store', 'App\Http\Controllers\FuelgasController@store')->name('fuelgas.store')->middleware('auth');
Route::post('/fuelgas/update/{id}', 'App\Http\Controllers\FuelgasController@update')->name('fuelgas.update')->middleware('auth');
Route::post('/vehicleroutetime/update/{id}', 'App\Http\Controllers\vehicleroutetimecontroller@update')->name('vehicleroutetime.update')->middleware('auth');


Route::get('/report/show', 'App\Http\Controllers\VehicleroutemapController@report')->name('report.show')->middleware('auth');


Route::post('/report/filter', 'App\Http\Controllers\VehicleroutemapController@reportfiltering')->name('report.filter')->middleware('auth');


Route::post('/veicledata/report', 'App\Http\Controllers\VehicleroutemapController@reportview')->name('report.details')->middleware('auth');
