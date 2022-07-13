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
        <link rel="stylesheet" href="../assets/css/styles.css">

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

        <main class="ma in">





            <!--==================== CONTACT ====================-->
            <section class="contact section container" id="contact">
                <div class="contact__container grid">
                    <div class="contact__box">

                        <h1 class="section__title " style="font-size: 50px">
                            To create order   Please enter this data <br>
                            <img src="{{asset('assets/img/paper.png')}}" alt="" class="about__img">
                        </h1>

                    </div>

                    <form action="{{route('orders.store')}}" method="POST" class="contact__form">
                        @csrf

                        <div class="contact__inputs">
                            <div class="contact__content">
                                <select id="cars" name="nawloon" class="contact__input gr ">
                                    <option></option>
                                    <option value="ضريبي">ضريبي</option>
                                    <option value="غير ضريبي">غير ضريبي</option>
                                </select>
                                <label for="" class="contact__label " style="font-size: 19px">Freight's type</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" "  name="nawloon_value" class="contact__input gr">
                                <label for="" class="contact__label">Freight's value</label>
                            </div>

                            <div class="contact__content">
                                <input type="text" placeholder=" " name="quantity" class="contact__input gr">
                                <label for="" class="contact__label">Quantity</label>
                            </div>

                            <div class="contact__content">
                                <input type="text" placeholder=" " name="driver_money" class="contact__input gr">
                                <label for="" class="contact__label">Driver's money</label>
                            </div>
                            <div class="contact__content">
                                <select id="cars" name="user_id" class="contact__input gr">
                                    <option></option>
                                    <option value="1">محمد الحنش</option>
                                    <option value="2">هبه عثمان</option>
                                </select>
                                <label for="" class="contact__label">User id</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " name="type" class="contact__input gr">
                                <label for="" class="contact__label">Type of product</label>
                            </div>
                            <div class="contact__content">
                                <select id="cars" name="option" class="contact__input gr">
                                    <option></option>
                                    <option value="صب">صب</option>
                                    <option value="معبأ">معبأ</option>
                                </select>
                                <label for="" class="contact__label">Product state</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " name="load_place" class="contact__input gr">
                                <label for="" class="contact__label">Load place</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " name="offload_place" class="contact__input gr">
                                <label for="" class="contact__label">Off-load place</label>
                            </div>
                        </div>

                        <button class="button button--flex">
                            Submit order
                            <i class="ri-arrow-right-up-line button__icon"></i>
                        </button>
                    </form>
                </div>
            </section>
        </main>

        <!--=============== SCROLL UP ===============-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-fill scrollup__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL ===============-->
        <script src="../assets/js/scrollreveal.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="../assets/js/main.js"></script>
    </body>
</html>



