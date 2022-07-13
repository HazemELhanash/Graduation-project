<?php

use App\Http\Controllers\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register','App\Http\Controllers\authController@register' )->name("register");
Route::post('login', 'App\Http\Controllers\authController@login')->name("login");
Route::get("/logout" , "App\Http\Controllers\authController@logout")->name("logout");

Route::middleware('auth:api')->group(function(){

    Route::resource("orders" , 'App\Http\Controllers\OrderController')->middleware("checkAdmin");

    Route::middleware("checkAssistant")->group(function(){
        Route::resource("trunks" , 'App\Http\Controllers\TrunkController');
        Route::resource("drivers" , 'App\Http\Controllers\DriverController');
        Route::resource("clients" , 'App\Http\Controllers\ClientController');
        Route::resource("cars" , 'App\Http\Controllers\CarController');
        Route::resource("shipments" , 'App\Http\Controllers\ShipmentController');
        Route::resource("products" , 'App\Http\Controllers\productController');
    });
    Route::resource("shipments" , 'App\Http\Controllers\ShipmentController');
    Route::resource("products" , 'App\Http\Controllers\productController');
});


