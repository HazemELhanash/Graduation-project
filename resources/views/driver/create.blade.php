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

        <main class="main">





            <!--==================== CONTACT ====================-->
            <section class="contact section container" id="contact">
                <div class="contact__container grid">
                    <div class="contact__box">
                        <h2 class="section__title" style="font-size: 50px">
                            To create driver  <br> Please enter this <br> data
                            <img src="{{asset('assets/img/paper.png')}}" alt="" class="about__img">
                        </h2>

                    </div>

                    <form action="{{route('drivers.store')}}" method="POST" class="contact__form">
                        @csrf

                        <div class="contact__inputs">


                            <div class="contact__content">
                                <input type="text" placeholder=" " name="name" class="contact__input gr">
                                <label for="" class="contact__label">Driver Name</label>
                            </div>

                            <div class="contact__content">
                                <input type="text" placeholder=" " name="phone" class="contact__input gr">
                                <label for="" class="contact__label">Driver Phone</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " name="address" class="contact__input gr">
                                <label for="" class="contact__label">Driver Address</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " name="money" class="contact__input">
                                <label for="" class="contact__label">Driver Money</label>
                            </div>

                        </div>

                        <button class="button button--flex">
                            Submit driver
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



