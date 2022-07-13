<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('index');

// Route::get('/rtl', function () {
//     return view('index');
// })->name('index');

Route::get('/join', function () {
    return view('join');
})->name("join");


Route::get('login', 'App\Http\Controllers\authController@login')->name("login");
Route::post('postlogin', 'App\Http\Controllers\authController@postlogin')->name("postlogin"); //
Route::get('/in', 'App\Http\Controllers\authController@index')->name("inndex"); //


Route::get('register', 'App\Http\Controllers\authController@register')->name("register");
Route::post('postregister', 'App\Http\Controllers\authController@postregister')->name("postregister");

Route::get("/logout", "App\Http\Controllers\authController@logout")->name("logout");

// الحاجات دي بنستخدمها عشان نحول كل شخص لصفحته
//----------------------------------------------

Route::post('contact', 'App\Http\Controllers\ContactController@store')->name("contact");
Route::post('/orderRequest' , 'App\Http\Controllers\OrderReqController@store')->name('request_store');

//Route::post("cars/report" , "App\Http\Controllers\CarController@report")->name("cars.report");
//Route::get('contact', 'App\Http\Controllers\ContactController@')->name(""); // when you are authenticated bro

//Route::post("shipments/update" , "App\Http\Controllers\ShipmentController@update")->name("shipments.update");

/*Route::get("cars" , "App\Http\Controllers\CarController@index")->name("cars.index");
Route::get("cars/create" , "App\Http\Controllers\CarController@create")->name("cars.create");
Route::post("cars/store" , "App\Http\Controllers\CarController@store")->name("cars.store");
Route::get("cars/edit/{id}" , "App\Http\Controllers\CarController@edit")->name("cars.edit");
Route::post("cars/update" , "App\Http\Controllers\CarController@update")->name("cars.update");
Route::get("cars/show/{id}" , "App\Http\Controllers\CarController@show")->name("cars.show");
Route::post("cars/delete/{id}" , "App\Http\Controllers\CarController@destroy")->name("cars.destroy");

Route::get("shipments" , "App\Http\Controllers\ShipmentController@index")->name("shipments.index");
Route::get("shipments/create" , "App\Http\Controllers\ShipmentController@create")->name("shipments.create");
Route::post("shipments/store" , "App\Http\Controllers\ShipmentController@store")->name("shipments.store");
Route::get("shipments/edit/{id}" , "App\Http\Controllers\ShipmentController@edit")->name("shipments.edit");
Route::post("shipments/update" , "App\Http\Controllers\ShipmentController@update")->name("shipments.update");
Route::get("shipments/show/{id}" , "App\Http\Controllers\ShipmentController@show")->name("shipments.show");
Route::post("shipments/delete/{id}" , "App\Http\Controllers\ShipmentController@destroy")->name("shipments.destroy");

Route::resource('shipments' , 'App\Http\Controllers\ShipmentController');
*/
Route::get('/manager', function () {
    return view('managerpage');
})->name("manager");


// Route::any('cars/report' , 'App\Http\Controllers\CarController@report')->name('cars.report');

Route::middleware('auth')->group(function () {
    /*
Route::get('admin' ,'App\Http\Controllers\adminController@index')->name('admin');
Route::get('assistant' ,'App\Http\Controllers\assistantController@index')->name('assistant.index');
Route::get('supervisor' ,'App\Http\Controllers\supervisorController@index')->name('supervisor.index');
*/

    //=====================FOR ADMIN MIDDLEWARE====================
    Route::middleware('checkAdmin')->group(function () {
    //==============view orders====================
    Route::resource('orders', 'App\Http\Controllers\OrderController');
    Route::get('orders/soft/delete/{id}', 'App\Http\Controllers\OrderController@softDelete')->name('soft.delete5');
    Route::get('orders/trash/as', 'App\Http\Controllers\OrderController@trashorder')->name('orders.trash');
    Route::get('orders/back/from/trash/{id}', 'App\Http\Controllers\OrderController@backFromSoftDelete')->name('order.back.from.trash');
    Route::get('orders/delete/from/database/{id}', 'App\Http\Controllers\OrderController@deleteForEver')->name('order.delete.from.database');
   //==============view contacts====================
    Route::get('contact', 'App\Http\Controllers\ContactController@show')->name('contacts.show');
    Route::get('contact/soft/delete/{id}', 'App\Http\Controllers\ContactController@softDelete')->name('soft.delete9');
    Route::get('contact/trash/as', 'App\Http\Controllers\ContactController@trashcontact')->name('contacts.trash');
    Route::get('contact/back/from/trash/{id}', 'App\Http\Controllers\ContactController@backFromSoftDelete')->name('contact.back.from.trash');
    Route::get('contact/delete/from/database/{id}', 'App\Http\Controllers\ContactController@deleteForEver')->name('contact.delete.from.database');

    Route::get('reporting' , function () {
        return view('admin.report');
    })->name("reporting");
    Route::get('orderReport' , 'App\Http\Controllers\OrderController@orderReport')->name("orderReport");
    //===================END===================

   //==============view order request====================

       Route::get('/orderRequest' , 'App\Http\Controllers\OrderReqController@index')->name('orderRequests');
       //Route::get('orderRequest/show/{id}' , 'App\Http\Controllers\OrderReqController@show')->name('ORshow');
       Route::resource('ordersR', 'App\Http\Controllers\OrderReqController');
       Route::get('orderRequest/soft/delete/{id}', 'App\Http\Controllers\OrderReqController@softDelete')->name('soft.delete10');
       Route::get('orderRequest/trash/as', 'App\Http\Controllers\OrderReqController@trashorderReq')->name('orderReq.trash');
       Route::get('orderRequest/back/from/trash/{id}', 'App\Http\Controllers\OrderReqController@backFromSoftDelete')->name('orderdReq.back.from.trash');
       Route::get('orderRequest/delete/from/database/{id}', 'App\Http\Controllers\OrderReqController@deleteForEver')->name('orderReq.delete.from.database');

//===================END===================


     });
     //=====================END ADMIN MIDDLEWARE====================


    Route::middleware("checkAssistant")->group(function () {
        Route::resource('shipments', 'App\Http\Controllers\ShipmentController');
        Route::resource('cars', 'App\Http\Controllers\CarController');
        Route::resource('drivers', 'App\Http\Controllers\DriverController');
        Route::resource('trunks', 'App\Http\Controllers\TrunkController');
        Route::resource('products', 'App\Http\Controllers\ProductController');
        Route::resource('customers', 'App\Http\Controllers\CustomerController');
        Route::resource('contacts', 'App\Http\Controllers\ContactController');
        Route::get('cars/soft/delete/{id}', 'App\Http\Controllers\CarController@softDelete')->name('soft.delete');
        Route::get('cars/archive/as', 'App\Http\Controllers\CarController@archivecar')->name('cars.archive');
        Route::get('cars/back/from/archive/{id}', 'App\Http\Controllers\CarController@backFromSoftDelete')->name('car.back.from.trash');
        Route::get('cars/delete/from/database/{id}', 'App\Http\Controllers\CarController@deleteForEver')->name('car.delete.from.database');

        Route::get('customers/soft/delete/{id}', 'App\Http\Controllers\CustomerController@softDelete')->name('soft.delete1');
        Route::get('customers/trash/as', 'App\Http\Controllers\CustomerController@trashcustomer')->name('customers.trash');
        Route::get('customers/back/from/trash/{id}', 'App\Http\Controllers\CustomerController@backFromSoftDelete')->name('customer.back.from.trash');
        Route::get('customers/delete/from/database/{id}', 'App\Http\Controllers\CustomerController@deleteForEver')->name('customer.delete.from.database');

        Route::get('drivers/soft/delete/{id}', 'App\Http\Controllers\DriverController@softDelete')->name('soft.delete2');
        Route::get('drivers/trash/as', 'App\Http\Controllers\DriverController@trashdriver')->name('drivers.trash');
        Route::get('drivers/back/from/trash/{id}', 'App\Http\Controllers\DriverController@backFromSoftDelete')->name('driver.back.from.trash');
        Route::get('drivers/delete/from/database/{id}', 'App\Http\Controllers\DriverController@deleteForEver')->name('driver.delete.from.database');

  // ===================    FOR REPORTING ABOUT DRIVERS ===============================
        Route::get('driver/rests/{id}', 'App\Http\Controllers\DriverController@getRests')->name('getRests');
        Route::get('driver/supplys/{id}', 'App\Http\Controllers\DriverController@getSupplys')->name('getSupplys');
        Route::get('driver/ships/{id}', 'App\Http\Controllers\DriverController@getShips')->name('getShips');
        Route::get('driver/report/{id}', 'App\Http\Controllers\DriverController@report')->name('getReport');

  // ===================    END REPORTING ABOUT DRIVERS ===============================


        Route::get('trunks/soft/delete/{id}', 'App\Http\Controllers\TrunkController@softDelete')->name('soft.delete3');
        Route::get('trunks/trash/as', 'App\Http\Controllers\TrunkController@trashtrunk')->name('trunks.trash');
        Route::get('trunks/back/from/trash/{id}', 'App\Http\Controllers\TrunkController@backFromSoftDelete')->name('trunk.back.from.trash');
        Route::get('trunks/delete/from/database/{id}', 'App\Http\Controllers\TrunkController@deleteForEver')->name('trunk.delete.from.database');


        Route::get('shipments/soft/delete/{id}', 'App\Http\Controllers\ShipmentController@softDelete')->name('soft.delete4');
        Route::get('shipments/trash/as', 'App\Http\Controllers\ShipmentController@trashshipment')->name('shipments.trash');
        Route::get('shipments/back/from/trash/{id}', 'App\Http\Controllers\ShipmentController@backFromSoftDelete')->name('shipment.back.from.trash');
        Route::get('shipments/delete/from/database/{id}', 'App\Http\Controllers\ShipmentController@deleteForEver')->name('shipment.delete.from.database');
    });



    //======================Goda=====================
    Route::resource('supervisors', 'App\Http\Controllers\GodaController')->middleware('checkSupervisor');
    Route::resource('shipments', 'App\Http\Controllers\ShipmentController', ['except' => 'index', 'delete']);
    Route::get('addMore/{id}', 'App\Http\Controllers\GodaController@addMore')->name('addMore')->middleware('checkSupervisor');

    //======================Goda=====================



    //=======================for driver mode route ===================

    Route::get('/driverpage', function () {
        return view('driverpage.index');
    })->name("driverpage");

    Route::get('/start-rest/{id}' , 'App\Http\Controllers\RestController@startRest')->name("start-rest");
    Route::get('/end-rest/{id}' , 'App\Http\Controllers\RestController@endRest')->name("end-rest");

    Route::get('/start-supply/{id}' , 'App\Http\Controllers\SupplyController@startSupply')->name("start-supply");
    Route::post('/end-supply/{id}' , 'App\Http\Controllers\SupplyController@endSupply')->name("end-supply");

    Route::get('/start-ship/{id}' , 'App\Http\Controllers\ShipController@startShip')->name("start-ship");
    Route::get('/end-ship/{id}' , 'App\Http\Controllers\ShipController@endShip')->name("end-ship");




    //Route::get('/updateSupply/{id}' , 'App\Http\Controllers\DriverController@updateSupply')->name("updateSupply");
    //Route::get('/updateRest/{id}' , 'App\Http\Controllers\DriverController@updateRest')->name("updateRest");
    //Route::get('/updateShipment/{id}' , 'App\Http\Controllers\DriverController@updateShipment')->name("updateShipment");

   });

  //=======================END driver mode route ===================



Route::get('/home', function () {
    return view('results');
})->name("home");





