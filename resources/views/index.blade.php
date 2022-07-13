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
        <link rel="stylesheet" href="{{asset('assets/css/popup.css')}}">

        {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>RTL</title>
    </head>
    <body>
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="{{route('inndex')}}" class="nav__logo">
                    <i class="ri-truck-line nav__logo-icon"></i> RTL
                </a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href="#about" class="nav__link">About</a>
                        </li>
                        <li class="nav__item">
                            <a href="#contact" class="nav__link">Contact Us</a>
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
            <!--==================== HOME ====================-->
            <section class="home" id="home">
                <div class="home__container container grid">
                    <img src="assets/img/color-gf4b6a10e0_1280.png"  alt="" class="home__img">

                    <div class="home__data">
                        <h1 class="home__title" style="font-size: 35pt;">
                            Future is here, <br> Start Exploring now.
                        </h1>
                        <p class="home__description">
                            RTL is a new, dynamically developing company on the market  and transportation services, with a focus on transportation of agricultural commodities, fertilizer, seeds , liquid commoditiesand any product which you need, if you are intersted in making order request please press the following button
                        </p>
                        <button class="button button--flex footer__button" onclick="document.getElementById('ticketModal').style.display='block'">Make Order Request</button>

                    </div>

                </div>
                 <!-- Ticket Modal -->
 <form action="{{route('request_store')}}" method="POST" >
    @csrf

  <div id="ticketModal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4" >
      <header class="w3-container w3-teal w3-center w3-padding-32" style="background-color: #e20a16">
        <span onclick="document.getElementById('ticketModal').style.display='none'"
       class="w3-button w3-teal w3-xlarge w3-display-topright">&times;</span>
        <h2 class="w3-wide" style="color: white"><i class="fa fa-suitcase w3-margin-right"></i>Request</h2>
      </header>
      <div class="w3-container">
        <p><label><i class="fa fa-shopping-cart"></i> Name </label></p>
        <input class="w3-input w3-border" type="text"  name="name">

        <p><label><i class="fa fa-shopping-cart"></i> phone 1</label></p>
        <input class="w3-input w3-border" type="text"  name="phone_1">

        <p><label><i class="fa fa-shopping-cart"></i> phone 2 ( OPTIONAL )</label></p>
        <input class="w3-input w3-border" type="text"   name="phone_2">

        <p><label><i class="fa fa-shopping-cart"></i> Email </label></p>
        <input class="w3-input w3-border" type="text"  name="email">

        <p><label><i class="fa fa-shopping-cart"></i> Address </label></p>
        <input class="w3-input w3-border" type="text"  name="adress">

        <p><label><i class="fa fa-shopping-cart"></i>  Product type</label></p>
        <input class="w3-input w3-border" type="text"  name="product_type">

        <p><label><i class="fa fa-shopping-cart"></i> Quantity</label></p>
        <input class="w3-input w3-border" type="text" placeholder="" name="quantity">
        <p><label><i class="fa fa-shopping-cart"></i> Message about order</label></p>
        <textarea class="w3-input w3-border"rows="5" type="text" placeholder="" name="details"></textarea>

        <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">S E N D  <i class="fa fa-check"></i></button>
        <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
      </div>

    </form>
  </div>


                    <div class="home__social">
                        <span class="home__social-follow">Follow Us</span>

                        <div class="home__social-links">
                            <a href="https://www.facebook.com/" target="_blank" class="home__social-link">
                                <i class="ri-facebook-fill"></i>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                                <i class="ri-instagram-line"></i>
                            </a>
                            <a href="https://twitter.com/" target="_blank" class="home__social-link">
                                <i class="ri-twitter-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== ABOUT ====================-->
            <section class="about section container" id="about">
                <div class="about__container grid" >
                    <img src="assets/img/about.png" alt="" class="about__img">

                    <div class="about__data">
                        <h2 class="section__title about__title">
                            Who we really are & <br> why choose us
                        </h2>

                        <p class="about__description">
                            We have over 4000+ unbiased reviews and our customers
                            trust our transportation process and delivery service every time
                        </p>

                        <div class="about__details">
                            <p class="about__details-description">
                                <i class="ri-checkbox-fill about__details-icon"></i>
                                We always deliver on time.
                            </p>
                            <p class="about__details-description">
                                <i class="ri-checkbox-fill about__details-icon"></i>
                                We give you guides to protect and care for your goods.
                            </p>
                            <p class="about__details-description">
                                <i class="ri-checkbox-fill about__details-icon"></i>
                                We always come over for a check-up after sale.
                            </p>
                            <p class="about__details-description">
                                <i class="ri-checkbox-fill about__details-icon"></i>
                                100% money back guaranteed.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== STEPS ====================-->
            <section class="steps section container"  >
                <div class="steps__bg">
                    <h2 class="section__title-center steps__title">
                        Steps to start your <br> order right now
                    </h2>

                    <div class="steps__container grid">
                        <div class="steps__card">
                            <div class="steps__card-number" style="background-color: #e20a16;">01</div>
                            <h3 class="steps__card-title">Contact us</h3>
                            <p class="steps__card-description">
                                Firstly comtact the team to start oredering process
                            </p>
                        </div>

                        <div class="steps__card">
                            <div class="steps__card-number" style="background-color: #e20a16;">02</div>
                            <h3 class="steps__card-title">Place an order</h3>
                            <p class="steps__card-description">
                                Once your order is set, we move to the next step which is the shipping.
                            </p>
                        </div>

                        <div class="steps__card">
                            <div class="steps__card-number" style="background-color: #e20a16;">03</div>
                            <h3 class="steps__card-title">Get gooods delivered</h3>
                            <p class="steps__card-description">
                                Our delivery process is easy, goods is taken to the destination .
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== QUESTIONS ====================-->
            <section class="questions section" id="faqs">
                <h2 class="section__title-center questions__title container">
                    Some common questions <br> were often asked
                </h2>

                <div class="questions__container container grid">
                    <div class="questions__group">
                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    What transport will be used?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                 we use different trucks and cars to deliver goods in perefect way.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Where can delivery be?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">

                                 We can deliver your goods anywhere you want only inside Egypt
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    what kinds of goods to deliver?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                   there ara many of goods such as legumes, wheat,feed and foods....etc.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="questions__group">
                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    How much does a transfer cost?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    According to the place of delivery, the cost is calculated next to the size of the goods.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    what types of trucks and cars that you want?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Depending on the quantity of the goods, the appropriate cars is provided.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is the merchandise transferred to me only once?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    The goods are moved more than once if the size of the goods is large.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== CONTACT ====================-->
            <section class="contact section container" id="contact">
                <div class="contact__container grid">
                    <div class="contact__box">
                        <h2 class="section__title">
                            Reach out to us today <br> via any of the given <br> information
                        </h2>

                        <div class="contact__data">
                            <div class="contact__information">
                                <h3 class="contact__subtitle">Call us for instant support</h3>
                                <span class="contact__description">
                                    <i class="ri-phone-line contact__icon"></i>
                                    +0100 422 9499
                                </span>
                            </div>

                            <div class="contact__information">
                                <h3 class="contact__subtitle">Write us by mail</h3>
                                <span class="contact__description">
                                    <i class="ri-mail-line contact__icon"></i>
                                    mohamed.hanash@rtleg.com
                                </span>
                            </div>
                        </div>
                    </div>
                    @include('sweetalert::alert')
                    <form action="{{ route('contact') }}" class="contact__form" method="POST">

                        @csrf
                        <div class="contact__inputs">
                            <div class="contact__content">
                                <input type="email" placeholder=" " class="contact__input"   name="email">
                                <label for="" class="contact__label" style="color: black">Email</label>
                            </div>

                            <div class="contact__content">
                                <input type="text" placeholder=" " class="contact__input" name="subject" >
                                <label for="" class="contact__label" style="color: black">Subject</label>
                            </div>

                            <div class="contact__content contact__area">
                                <textarea name="message" placeholder=" " class="contact__input" name="message"></textarea>
                                <label for="" class="contact__label" style="color: black">Message</label>
                            </div>
                        </div>

                        <button class="button button--flex">
                            Send Message
                            <i class="ri-arrow-right-up-line button__icon"></i>
                        </button>
                    </form>
                </div>
            </section>
        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">
                        <i class="ri-truck-line footer__logo-icon"></i> RTL
                    </a>

                    <h3 class="footer__title">
                        Subscribe to our newsletter <br> to stay update
                    </h3>

                    <div class="footer__subscribe">
                        <input type="email" placeholder="Enter your email" class="footer__input">

                        <button class="button button--flex footer__button">
                            Subscribe
                            <i class="ri-arrow-right-up-line button__icon"></i>
                        </button>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Our Address</h3>

                    <ul class="footer__data">
                        <li class="footer__information">59 - Al Multaqa Al Arabi st.</li>
                        <li class="footer__information">Sheraton Cairo</li>
                        <li class="footer__information">Helioplis</li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Contact Us</h3>

                    <ul class="footer__data">
                        <li class="footer__information">+0100 422 9499</li>
                        <li class="footer__information">+202 206 44 107</li>

                    </ul>
                </div>
            </div>
        </footer>

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
