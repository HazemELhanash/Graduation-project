
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
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/buttons.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">

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
                            <a href="{{route('index')}}" class="nav__link active-link">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href=" {{route('index')}}" class="nav__link">About</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{route('index')}}" class="nav__link">Contact Us</a>
                        </li>
                        @guest
                        <li class="nav__item">
                            <a href="{{route('join')}}" class="nav__link">Sign in</a>
                        </li>
                        @endguest
                        <li class="nav__item">
                            <a href="{{route('logout')}}" class="nav__link">Logout</a>
                        </li>
                    </ul>

                    <div class="nav__close" id="nav-close">
                        <i class="ri-close-line"></i>
                    </div>
                </div>

                <div class="nav__btns">
                    <!-- Theme change button -->
                    {{-- <i class="ri-moon-line change-theme" id="theme-button"></i> --}}

                    <div class="nav__toggle" id="nav-toggle">
                        <i class="ri-menu-line"></i>
                    </div>
                </div>
            </nav>
        </header>

        <main class="main">





            <!--==================== CONTACT ====================-->
            @yield("content")
        </main>

        <!--=============== SCROLL UP ===============-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-fill scrollup__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL ===============-->
        <script src="{{asset('assets/js/scrollreveal.min.js')}}"></script>

        <!--=============== MAIN JS ===============-->
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/jszip.min.js')}}"></script>
        <script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('assets/js/adminlte.min.js')}}"></script>

        <script>
            $(function () {
              $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": ture,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
              });
            });
          </script>
           <script>
            $(function () {
              $("#example3").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
              $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": ture,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
              });
            });
          </script>
           <script>
            $(function () {
              $("#example4").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
              $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": ture,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
              });
            });
          </script>




    </body>
</html>
