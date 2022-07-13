@php
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Carbon\Carbon;
use App\Models\Car;


//================ORDER==============
$order = Order::all();
$tax_counter = 0;
$untax_counter = 0;
foreach ($order as $d) {
    if ($d->nawloon == 'ضريبي') {
        $tax_counter++;
    } else {
        $untax_counter++;
    }
}

//for shipments and orders
$current_month_orders = Order::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();

$before_1_month_order = Order::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(1))
    ->count();

$before_2_month_order = Order::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(2))
    ->count();

$before_3_month_order = Order::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(3))
    ->count();

$before_4_month_order = Order::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(4))
    ->count();

$before_5_month_order = Order::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(5))
    ->count();


//عشان بيعد عدد الاوردرات  في كل شهر
$order_count = [$current_month_orders, $before_1_month_order, $before_2_month_order, $before_3_month_order, $before_4_month_order, $before_5_month_order];

$month = [];
$count = 0;
while ($count <= 5) {
    $month[] = date('M Y', strtotime('-' . $count . 'month'));
    $count++;
}
//dd($month);
$dataPoints = [['y' => $order_count[0], 'label' => $month[0]], ['y' => $order_count[1], 'label' => $month[1]], ['y' => $order_count[2], 'label' => $month[2]], ['y' => $order_count[3], 'label' => $month[3]], ['y' => $order_count[4], 'label' => $month[4]], ['y' => $order_count[5], 'label' => $month[5]]];

//================ End ORDER==============

//================Shipments==============

//for shipments and orders
$current_month_shipments = Shipment::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();

$before_1_month_shipment = Shipment::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(1))
    ->count();

$before_2_month_shipment = Shipment::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(2))
    ->count();

$before_3_month_shipment = Shipment::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(3))
    ->count();

$before_4_month_shipment = Shipment::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(4))
    ->count();

$before_5_month_shipment = Shipment::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->subMonth(5))
    ->count();

//عشان بيعد عدد الاوردرات  في كل شهر
$shipment_count = [$current_month_shipments, $before_1_month_shipment, $before_2_month_shipment, $before_3_month_shipment, $before_4_month_shipment, $before_5_month_shipment];

$month = [];
$count = 0;
while ($count <= 5) {
    $month[] = date('M Y', strtotime('-' . $count . 'month'));
    $count++;
}

$shipmentPoints = [['y' => $shipment_count[0], 'label' => $month[0]],
                 ['y' => $shipment_count[1], 'label' => $month[1]],
                  ['y' => $shipment_count[2], 'label' => $month[2]],
                   ['y' => $shipment_count[3], 'label' => $month[3]],
                    ['y' => $shipment_count[4], 'label' => $month[4]],
                    ['y' => $shipment_count[5], 'label' => $month[5]]];

//================ End Shipments==============

// echo  $current_date=date('M Y' ,strtotime("-0 month") );
// echo "<pre>"; dd($order_count);

//================= Shipment-id with Income ==========================

$shipment = DB::table('shipment')
    ->get('*')
    ->toArray();
foreach ($shipment as $row) {
    $data[] = array('label' =>$row->id,
        'y' =>  $row->incoming_value,
    );
}

//=================  end of Shipment-id with Income ==========================

//================= Products ==========================
$product = Product::all();
$sab = 0;
$full= 0;
foreach ($product as $d) {
    if ($d->option == 'صب') {
        $sab++;
    } else {
        $full++;
    }
}

//================= end of Products ==========================

//================Orders with Incoming Value Graph================

$order=Order::all();
$shipment=Shipment::all();
$incoming_value=0;
$order_income=array();

foreach ($order as $o) {
    $shipment_for_order=  DB::table('shipment')->where('order_id', $o->id)->get();
    foreach ($shipment_for_order as $ship) {
        $incoming_value+= $ship->incoming_value;
    }
    $order_income[$o->id]=$incoming_value;
    $incoming_value=0;
}

foreach ($order as $row) {
    $data1[] = array('label' =>$row->id,
        'y' =>  $order_income[$row->id],
    );
}


//  == = == = = =  CODE FOR CARS AND SHIPMENTS = = = =  =

// $cars=Car::all();
// $count=0;
// $no_of_shipments_per_car= array();

// foreach ($cars as $car) {
//     $shipments=DB::table('shipment')->where('car_code' , $car->car_code)->get();
//     foreach ($shipments as $ship) {
//        $count++;
//     }
//     $no_of_shipments_per_car[$car->car_code]=$count;
//     $count=0;
// }

// foreach ($cars as $row) {
//     $data2[] = array('label' =>$row->car_code,
//         'y' =>  $no_of_shipments_per_car[$row->car_code] ,
//     );
// }


//  == = == = = = END  CODE FOR CARS AND SHIPMENTS = = = =  =

//  == = == = = =  CODE FOR DRIVERS AND SHIPMENTS = = = =  =

// $drivers=Driver::all();
// $count=0;
// $no_of_shipments_per_driver= array();

// foreach ($drivers as $driver) {
//     $shipments=DB::table('shipment')->where('driver_name' , $driver->name)->get();
//     foreach ($shipments as $ship) {
//        $count++;
//     }
//     $no_of_shipments_per_driver[$driver->name]=$count;
//     $count=0;
// }

// foreach ($drivers as $row) {
//     $data3[] = array('label' =>$row->name,
//         'y' =>  $no_of_shipments_per_driver[$row->name] ,
//     );
// }


//  == = == = = = END  CODE FOR CARS AND SHIPMENTS = = = =  =


@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIX ICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/tt.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>RTL</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ route('inndex') }}" class="nav__logo">
                <i class="ri-truck-line nav__logo-icon"></i> RTL
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('index') }}" class="nav__link active-link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('index') }}" class="nav__link">About</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('index') }}" class="nav__link">Contact Us</a>
                    </li>
                    @guest
                        <li class="nav__item">
                            <a href="{{ route('join') }}" class="nav__link">Sign in</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav__item">
                            <a href="{{ route('logout') }}" class="nav__link">Logout</a>
                        </li>
                    @endauth
                </ul>

                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>

            <div class="nav__btns">
                <!-- Theme change button -->
                <i class="ri-moon-line change-theme" id="theme-button"></i>

                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
        </nav>
    </header>



    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-fill scrollup__icon"></i>
    </a>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                         <!--================== ORDER/MONTH====================-->
                                <div class="card  " >
                                   <div class="card-header re ">
                                            <br>
                                            <br>
                                            <br>
                                            <br><table style="border: none"><tr>
                                            <td style="padding-left:0px;padding-right:10px"><h3>Order/Month</h3></td>
                                            <td style="padding-rigth:35px; "><select name="chart" onchange="myFunction()" class="form-control" id="chart" style="width: 250px;">
                                                <option value="" disabled selected >Select Your Chart Type</option>
                                                <option value="pie">Pie</option>
                                                <option value="column">Column</option>
                                                <option value="pyramid">Pyramid</option>
                                                <option value="bar">Bar</option>
                                            </select></td>
                                        <td style="padding-left:140px;padding-right:0px; padding-top:px"><div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                                </svg>
                                            </button>
                                        </div></td></tr></table>
                                        </div>
                                        <div class="card-body">
                                        <div class="chart">
                                            <div id="chartContainer" style="height: 370px; width: 100%"></div>

                                        </div>
                                    </div>

                                 </div>


                         <!--================== Shipment/income ====================-->
                                <div class="card  ">
                                    <div class="card-header re ">

                                        <br><table style="border: none"><tr>
                                        <td style="padding-left:0px;padding-right:10px"><h3> Shipment/Income</h3></td>
                                        <td style="padding-rigth:35px; "><select name="chart2" onchange="myFunction2()" class="form-control" id="chart2" style="width: 230px">
                                            <option value="" disabled selected >Select Your Chart Type</option>
                                            <option value="pie">Pie</option>
                                            <option value="column">Column</option>
                                            <option value="pyramid">Pyramid</option>
                                            <option value="bar">Bar</option>
                                        </select></td>
                                    <td style="padding-left:100px;padding-right:0px; padding-top:px"><div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                            </svg>
                                        </button>
                                    </div></td></tr></table>
                                    </div>
                                    <div class="card-body">
                                    <div class="chart">
                                        <div id="chartContainer2" style="height: 370px; width: 100%"></div>
                                    </div>
                                    </div>
                                    </div>
                          <!--==================Shipment/Car_code ====================-->
                                {{-- <div class="card  ">
                                    <div class="card-header re ">

                                        <br><table style="border: none"><tr>
                                        <td style="padding-left:0px;padding-right:10px"><h3>Shipment/Car_code </h3></td>
                                        <td style="padding-rigth:35px; "><select name="chart6" onchange="myFunction6()" class="form-control" id="chart6" style="width: 220px">
                                            <option value="" disabled selected >Select Your Chart Type</option>
                                            <option value="pie">Pie</option>
                                            <option value="column">Column</option>
                                            <option value="pyramid">Pyramid</option>
                                            <option value="bar">Bar</option>
                                        </select>
                                         </td>
                                    <td style="padding-left:80px;padding-right:0px; padding-top:px"><div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                            </svg>
                                        </button>
                                    </div></td></tr></table>
                                    </div>
                                    <div class="card-body">
                                    <div class="chart">
                                        <div id="chartContainer6" style="height: 370px; width: 100%"></div>
                                    </div>
                                    </div>
                                    </div> --}}


                           <!--==================TAX VS UNTAX ====================-->
                                <div class="card  ">
                                    <div class="card-header re ">

                                            <br><table style="border: none"><tr>
                                            <td style="padding-left:0px;padding-right:10px"><h3>TAX VS UNTAX</h3></td>

                                        <td style="padding-left:375px;padding-right:0px; padding-top:px"><div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                                </svg>
                                            </button>
                                        </div></td></tr></table>
                                        </div>
                                        <div class="card-body">
                                        <div class="chart">
                                            <canvas id="myChart" style="margin-left: 20px; margin-right:20px; min-width:100px;min-height:100px" ></canvas>
                                            <br>
                                            <br>



                                        </div>
                                        </div>
                                 </div>
                     </div>



                    <div class="col-md-6">
                        <div class="card  ">
                            <div class="card-header re ">
                            <br>
                            <br>
                            <br>
                                <br><table style="border: none"><tr>
                                <td style="padding-left:0px;padding-right:10px"><h3>Order/Income</h3></td>
                                <td style="padding-rigth:35px; "><select name="chart5" onchange="myFunction5()" class="form-control" id="chart5" style="width: 250px">
                                    <option value="" disabled selected >Select Your Chart Type</option>
                                    <option value="column">Column</option>
                                    <option value="pyramid">Pyramid</option>
                                    <option value="bar">Bar</option>
                                </select></td>
                            <td style="padding-left:120px;padding-right:0px; padding-top:px"><div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                </button>
                            </div></td></tr></table>
                            </div>
                            <div class="card-body">
                            <div class="chart">
                                <div id="chartContainer5" style="height: 370px; width: 100%"></div>
                            </div>
                            </div>
                            </div>

                          <!--================== Shipment/month ====================-->
                        <div class="card  ">
                            <div class="card-header re ">

                                <br><table style="border: none"><tr>
                                <td style="padding-left:0px;padding-right:10px"><h3>Shipment/Month</h3></td>
                                <td style="padding-rigth:35px; "><select name="chart1" onchange="myFunction1()" class="form-control" id="chart1" style="width: 230px">
                                    <option value="" disabled selected >Select Your Chart Type</option>
                                    <option value="pie">Pie</option>
                                    <option value="column">Column</option>
                                    <option value="pyramid">Pyramid</option>
                                    <option value="bar">Bar</option>
                                </select></td>
                            <td style="padding-left:110px;padding-right:0px; padding-top:px"><div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                </button>
                            </div></td></tr></table>
                            </div>
                            <div class="card-body">
                            <div class="chart">
                                <div id="chartContainer1" style="height: 370px; width: 100%"></div>
                            </div>
                            </div>
                            </div>
                             <!--==================Shipment/Driver_name ====================-->
                             {{-- <div class="card  ">
                                <div class="card-header re ">

                                    <br><table style="border: none"><tr>
                                    <td style="padding-left:0px;padding-right:10px"><h3>Shipment/Driver Name </h3></td>
                                    <td style="padding-rigth:35px; "><select name="chart7" onchange="myFunction7()" class="form-control" id="chart7" style="width: 220px">
                                        <option value="" disabled selected >Select Your Chart Type</option>
                                        <option value="pie">Pie</option>
                                        <option value="column">Column</option>
                                        <option value="pyramid">Pyramid</option>
                                        <option value="bar">Bar</option>
                                    </select>
                                     </td>
                                <td style="padding-left:50px;padding-right:0px; padding-top:px"><div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                        </svg>
                                    </button>
                                </div></td></tr></table>
                                </div>
                                <div class="card-body">
                                <div class="chart">
                                    <div id="chartContainer7" style="height: 370px; width: 100%"></div>
                                </div>
                                </div>
                                </div> --}}
                        <!--================== sub vs full====================-->
                        <div class="card  ">
                            <div class="card-header re ">

                                    <br><table style="border: none"><tr>
                                    <td style="padding-left:0px;padding-right:10px"><h3>SUB VS FULL</h3></td>

                                <td style="padding-left:375px;padding-right:0px; padding-top:px"><div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                        </svg>
                                    </button>
                                </div></td></tr></table>
                                </div>
                                <div class="card-body">
                                <div class="chart">
                                    <canvas id="myChartt" style="margin-left: 20px; margin-right:20px; min-width:100px;min-height:100px" ></canvas>
                                    <br>
                                    <br>

                                </div>
                                </div>
                                </div>

                         </div>

                         </div>


                    </div>

                </div>
             </div>

        </section>



    <!--=============== SCROLL REVEAL ===============-->
    <script src="../assets/js/scrollreveal.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
    <script src="assets/js/demo.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

     <!--================== PIE GRAPH FOR PRODUCTS ====================-->

     <script>

        var xValues = ["ضريبي ", "غير ضريبي"];
        var yValues = [{{$tax_counter}},{{$untax_counter}}];
        var barColors = [
          "#006E7F",
          "#CDC2AE"
        ];

        new Chart("myChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "TAX VS UNTAX"
            }
          }
        });
        </script>

    <script>
        var xValues = ["صب", "معبأ"];
        var yValues = [{{ $sab }}, {{ $full }}];
        var barColors = [
            "#646FD4",
            "#242F9B"
        ];

        new Chart("myChartt", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "نوع المنتج"
                }
            }
        });

    </script>




        <script>
            function myFunction5() {
                var charType =document.getElementById("chart5").value;
                var chart = new CanvasJS.Chart("chartContainer5", {
                    animationEnabled:true,
                    title: {
                        text: "Order/Income"
                    },
                    axisX: {
                        title: "عدد الاوامر",

                    },
                    axisY: {
                        title:"الايراد",

                    },
                    data: [{
                        type: charType,
                        markerSize: 0,
                        xValueFormatString: "#,##0 ",
                        yValueFormatString: "#,##0.000 ",
                        dataPoints: <?php echo json_encode($data1, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>















     {{-- <script>
        var xValues = ["ضريبي", "غير ضريبي"];
        var yValues = [{{ $tax_counter }}, {{ $untax_counter }}];
        var barColors = [
            "#b91d47",
            "#1e7145"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "نوع الاوردر"
                }
            }
        });
    </script> --}}




        <script>
            function myFunction() {
                var charType =document.getElementById("chart").value;
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled:true,
                    title: {
                        text: "Order/Month"
                    },
                    axisX: {
                        title: "عدد الاوامر",

                    },
                    axisY: {
                        title: "الشهر بالسنه",

                    },
                    data: [{
                        type: charType,
                        markerSize: 0,
                        xValueFormatString: "#,##0 ",
                        yValueFormatString: "#,##0.000 ",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>





<script>
            function myFunction1() {
                var charType =document.getElementById("chart1").value;
                var chart = new CanvasJS.Chart("chartContainer1", {
                    animationEnabled:true,
                    title: {
                        text: "Shipment/Month"
                    },
                    axisX: {
                        title: "عدد اوامر الشغل",

                    },
                    axisY: {
                        title: "الشهر بالسنه",

                    },
                    data: [{
                        type: charType,
                        markerSize: 0,
                        xValueFormatString: "#,##0 ",
                        yValueFormatString: "#,##0.000 ",
                        dataPoints: <?php echo json_encode($shipmentPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>






<script>
            function myFunction2() {
                var charType =document.getElementById("chart2").value;
                var chart = new CanvasJS.Chart("chartContainer2", {
                    animationEnabled:true,
                    title: {
                        text: "Shipment/Income"
                    },
                    axisX: {
                        title: "عدد اوامر الشغل",

                    },
                    axisY: {
                        title: "الايراد  ",

                    },
                    data: [{
                        type: charType,
                        markerSize: 0,
                        xValueFormatString: "#,##0 ",
                        yValueFormatString: "#,##0.000 ",
                        dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>



    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
</body>

</html>
