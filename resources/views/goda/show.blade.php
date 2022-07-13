<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}" type="image/x-icon">

        <!--=============== REMIX ICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">

        <title>RTL</title>
    </head>
    <body>
        @include('sweetalert::alert')
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="{{route('inndex')}}" class="nav__logo">
                    <i class="ri-truck-line nav__logo-icon"></i> RTL
                </a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="{{route('index')}}" class="nav__link active-link">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{route('index')}}" class="nav__link">About</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{route('index')}}" class="nav__link">Contact Us</a>
                        </li>
                        @guest
                        <li class="nav__item">
                            <a href="{{route('join')}}" class="nav__link">Sign in</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav__item">
                        <a href="{{route('logout')}}" class="nav__link">Logout</a>
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

        <main class="main">


            <!--==================== CONTACT ====================-->
            <section class="steps section container"  >
                <div class="steps__bg">
                    <a href="{{route('supervisors.index')}}" style="color: white  ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                          </svg>
                    </a>
                    <h2 class="section__title-center steps__title">
                        Show Shipment
                    </h2>

                    <div class="steps__container grid">

                             <div class="contact__content">

                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->load_place}}">
                                <label for="" class="contact__label w color"style="font-size:16px">مكان التحميل</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->offload_place}}">
                                <label for="" class="contact__label w color"style="font-size:16px">مكان التعتيق</label>
                            </div>

                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly value="{{$data->elkaam}}">
                                <label for="" class="contact__label w color"style="font-size:16px">القائم</label>
                            </div>

                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly value="{{$data->empty}}" style="margin-top: 8px">
                                <label for="" class="contact__labelw color"style="font-size:16px">الفارغ</label>
                            </div>
                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly value="{{$data->rest}}">
                                <label for="" class="contact__label w color"style="font-size:16px">الصافي</label>
                            </div>

                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->car->car_code}}">
                                <label for="" class="contact__label w color"style="font-size:16px">كود السيارة</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->trunk->trunk_code}}">
                                <label for="" class="contact__label w color"style="font-size:16px">كود المقطورة</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->customer->name}}">
                                <label for="" class="contact__label w color"style="font-size:16px">اسم العميل</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->driver->name}}">
                                <label for="" class="contact__label w color"style="font-size:16px">اسم السائق</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->counter_begin}}">
                                <label for="" class="contact__label w color"style="font-size:16px">عداد البداية</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->counter_end}}">
                                <label for="" class="contact__label w color"style="font-size:16px">عداد النهاية</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->kilometers_per_trip}}">
                                <label for="" class="contact__label w color"style="font-size:16px">كيلو متر/الرحلة</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->distnation}}">
                                <label for="" class="contact__label w color"style="font-size:16px"> الوجهة</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->policy_number}}">
                                <label for="" class="contact__label w color"style="font-size:16px">رقم البوليصة </label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" name="order_id" value="{{$data->order_id}}">
                                <label for="" class="contact__label w color"style="font-size:16px">رقم الطلب </label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->incoming_value}}">
                                <label for="" class="contact__label w color"style="font-size:16px">الوارد </label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->taxes}}">
                                <label for="" class="contact__label w color"style="font-size:16px">قيمة الضريبة المضافة  </label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly value="{{$data->created_at}}">
                                <label for="" class="contact__label w color"style="font-size:16px"> التاريخ</label>
                            </div>


                            <br>
                            &nbsp;
                            <div >
                                <img src="{{asset('assets/img/paper.png')}}" alt="" class="about__img">
                            </div>
                            <br>
                            <br>


                    </div>
                </div>
            </section>


        </main>

        <!--=============== SCROLL UP ===============-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-fill scrollup__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL ===============-->
        <script src="{{asset('assets/js/scrollreveal.min.js')}}"></script>

        <!--=============== MAIN JS ===============-->
        <script src="{{asset('assets/js/main.js')}}"></script>
    </body>
</html>
