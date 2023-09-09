<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('files', 'App\Http\Controllers\Backend\BatchController@getallfiles');

Route::get('files/{id}', 'App\Http\Controllers\Backend\BatchController@getfilesbyid');

Route::post('addfiles', 'App\Http\Controllers\Backend\BatchController@addfiles');

Route::put('updatefiles/{id}', 'App\Http\Controllers\Backend\BatchController@updatefiles');

Route::delete('deletefiles/{id}', 'App\Http\Controllers\Backend\BatchController@deletefiles');

Route::get('items', 'App\Http\Controllers\ItemController@getitems');

Route::get('edititem/{id}', 'App\Http\Controllers\ItemController@edititem');

Route::post('additems', 'App\Http\Controllers\ItemController@insertitem');
Route::post('updateitem/{id}', 'App\Http\Controllers\ItemController@updateitem');

Route::get('deleteitems/{id}', 'App\Http\Controllers\ItemController@destroy');


Route::get('vehicles/list', 'App\Http\Controllers\ItemController@getvehicles');
