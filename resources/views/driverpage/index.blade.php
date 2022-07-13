@php
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Driver;
use App\Models\Rest;
use App\Models\Supply;
use App\Models\Ship;

$user = User::find(Auth::id());
$driver = DB::table('drivers')
    ->where('name', $user->name)
    ->first();

$rest = Rest::where('driver_id', $driver->id)
    ->orderBy('created_at', 'desc')
    ->first();
// dd($rest);
if ($rest != null) {
    $Endrest = $rest->end_at;
    if ($Endrest == null) {
        $show_end_rest = 1;
        $Endrest = -1;
    } else {
        $show_end_rest = 0;
    }
}

$supply = Supply::where('driver_id', $driver->id)
    ->orderBy('created_at', 'desc')
    ->first();

// dd($supply);
if ($supply != null) {
    $Endsupply = $supply->end_at;
    if ($Endsupply == null) {
        $show_end_supply = 1;
        $Endsupply = -1;
    } else {
        $show_end_supply = 0;
        // dd($show_end_supply);
    }
}

$ship = Ship::where('driver_id', $driver->id)
    ->orderBy('created_at', 'desc')
    ->first();

if ($ship != null) {
    $Endship = $ship->end_at;
    if ($Endship == null) {
        $show_end_ship = 1;
        $Endship = -1;
    } else {
        $show_end_ship = 0;
    }
}

// dd(isset($Endrest));
// dd($Endrest);

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
    <link href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>RTL</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">
                <i class="ri-truck-line nav__logo-icon"></i> RTL
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('index') }}" class="nav__link active-link"
                            style="font-family:  'Droid Arabic Kufi', serif;">الصفحة الرئيسية</a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('logout') }}" class="nav__link"
                            style="font-family:  'Droid Arabic Kufi', serif;">تسجيل الخروج</a>
                    </li>
                </ul>




        </nav>
    </header>

    @include('sweetalert::alert')


    <main class="main">
        <!--==================== HOME ====================-->
        <section class="steps section container">
            <audio controls muted>
                <source src="assets/audios/driver.m4a" type="audio/mpeg">
            </audio>
            <div class="steps__bg" style="background-color:#e20a16; height: 600px; ">
                <h2 class="section__title-center steps__title" style="font-family: 'droidarabickufi';">
                    اهلا بيك
                </h2>

                <div class="steps__container grid">
                    <div class="steps__card" >
                        <h3 class="steps__card-title"
                            style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">بنزين
                        </h3>
                        <p style="font-family: 'Droid Arabic Kufi', serif;">لو هتمون/مونت دوس على الزرار</p>
                        <br>
                        @if (isset($Endsupply))
                            @if ($show_end_supply == 0)
                                <a href="{{ route('start-supply' , $driver->id) }}" class="button button--flex footer__button"
                                style="background-color:orange ; color:white"> <span style="font-family: 'Droid Arabic Kufi',
                                 serif;font-weight: bold; font-size:20px ">   همون </span> </a>
                            @elseif($show_end_supply == 1)
                                <form action="{{route('end-supply' , $supply->id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method("POST")

                                    <input  type="submit" class="button button--flex footer__button" style=" border-color:green;background-color:green
                                    ; color:white;font-family: 'Droid Arabic Kufi', serif; font-size:20px ;margin-bottom:px" value="  خلصت تموين" >
                                    <br>
                                    <label style="font-size: bold; color:black; font-size:20px ;padding-top:20px;font-family:
                                     'Droid Arabic Kufi', serif;"> تكلفة التموين</label><br>
                                    <input type="file" name="image_path" style=" margin-left:8px;border-radius: 5px;width:105px;border-color: lightgray" required >


                              </form>

                            @endif
                        @else
                        <a href="{{ route('start-supply' , $driver->id) }}" class="button button--flex footer__button" style="background-color:orange ;
                         color:white"> <span style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">   همون </span> </a>
                        @endif
                    </div>



                    <div class="steps__card">
                        <h3 class="steps__card-title" style="font-family: 'Droid Arabic Kufi', serif; font-size:20px">
                            راحة</h3>
                        <p class="steps__card-description" style="font-family: 'Droid Arabic Kufi', serif;">
                            لو هتاخد/ خدت راحه دوس على الزرار
                        </p>
                        <br>

                        @if (isset($Endrest))
                            @if ($show_end_rest == 0)
                                <a href="{{ route('start-rest', $driver->id) }}"
                                    class="button button--flex footer__button"
                                    style="background-color:blue ; color:white"> <span
                                        style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">
                                        هاخد راحة </span> </a>
                            @elseif($show_end_rest == 1)
                                <a href="{{ route('end-rest', $rest->id) }}"
                                    class="button button--flex footer__button"
                                    style="background-color:black  ; color:white"> <span
                                        style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">
                                        خدت راحة </span> </a>
                            @endif
                        @else
                            <a href="{{ route('start-rest', $driver->id) }}"
                                class="button button--flex footer__button" style="background-color:blue ; color:white">
                                <span
                                    style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">
                                    هاخد راحة </span> </a>

                        @endif

                    </div>



                    <div class="steps__card">
                        <h3 class="steps__card-title" style="font-family: 'Droid Arabic Kufi', serif;font-size:20px">
                            نقله</h3>
                        <p style="font-family: 'Droid Arabic Kufi', serif;">لو طالع/طلعت نقله دوس على الزرار</p>
                        <br>
                        @if (isset($Endship))
                            @if ($show_end_ship == 0)
                                <a href="{{ route('start-ship', $driver->id) }}"
                                    class="button button--flex footer__button"
                                    style="background-color:grey ; color:black"> <span
                                        style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">
                                        بدأت النقلة </span> </a>
                            @elseif($show_end_ship == 1)
                                <a href="{{ route('end-ship', $ship->id) }}"
                                    class="button button--flex footer__button"
                                    style="background-color:red  ; color:white"> <span
                                        style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">
                                        خلصت النقلة </span> </a>
                            @endif
                        @else
                            <a href="{{ route('start-ship', $driver->id) }}"
                                class="button button--flex footer__button" style="background-color:grey ; color:black">
                                <span
                                    style="font-family: 'Droid Arabic Kufi', serif;font-weight: bold; font-size:20px ">
                                    بدأت النقلة </span> </a>
                        @endif
                    </div>



                </div>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->


    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-fill scrollup__icon"></i>
    </a>

    <!--=============== SCROLL REVEAL ===============-->
    <script src="assets/js/scrollreveal.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>

</html>
