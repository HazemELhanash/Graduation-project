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
                    <a href="{{route('trunks.index')}}" style="color: white  ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                          </svg>
                    </a>
                    <h2 class="section__title-center steps__title">
                        Show Truck
                    </h2>

                    <div class="steps__container grid">

                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly name="trunk_code" value="{{$trunk->trunk_code}}">
                                <label for="" class="contact__label w color"style="font-size:16px">Truck's code</label>
                            </div>

                            <br>
                            &nbsp;
                            <div >
                                <img src="../assets/img/paper.png" alt="" class="about__img">
                            </div>
                            <br>
                            <br>


                    </div>
                </div>
            </section>

              <!-- <section class="steps section container" id="contact" >
                    <div class="steps__bg">

                        <h2 class="section__title-center steps__title">
                            Show Order
                        </h2>
                    <div class="contact__box ">
                    <form action="" class="contact__form">


                        <div class="contact__inputs ">
                           <div style="margin-right: 50%;">
                            <div class="contact__content">

                                <input type="text" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Freight's type</label>
                            </div>
                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Freight's value</label>
                            </div>

                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Quantity</label>
                            </div>

                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Driver's money</label>
                            </div>
                            <div class="contact__content">
                                <input type="number" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">User id</label>
                            </div>
                            </div>

                            <div style="margin-right: 50%;">
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Type of product</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Process of product</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Load place</label>
                            </div>
                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" readonly>
                                <label for="" class="contact__label w">Off-load place</label>
                            </div>
                            </div>
                        </div>

                        </table>
                    </form>
                </div>
                </div>
            </section>-->
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
