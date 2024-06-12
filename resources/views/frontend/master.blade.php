<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/bootstrap.min.css') }}" />
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/animate.min.css') }}" />
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/fonts/flaticon.css') }}" />
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/boxicons.min.css') }}" />
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/magnific-popup.css') }}" />
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/owl.theme.default.min.css') }}" />
    <!-- Nice Select Min CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/nice-select.min.css') }}" />
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/meanmenu.css') }}" />
    <!-- Jquery Ui CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/jquery-ui.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/ssets/css/responsive.css') }}a" />
    <!-- Theme Dark CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/theme-dark.css') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Frontend/assets/img/favicon.png') }}" />

    <title>Imran - Hotel & Resorts </title>
</head>

<body>
    <!-- PreLoader Start -->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="sk-cube-area">
                    <div class="sk-cube1 sk-cube"></div>
                    <div class="sk-cube2 sk-cube"></div>
                    <div class="sk-cube4 sk-cube"></div>
                    <div class="sk-cube3 sk-cube"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- PreLoader End -->

    <!-- Top Header Start -->
    @include('frontend.body.header')
    <!-- Top Header End -->

    <!-- Start Navbar Area -->
    @include('frontend.body.navbar')
    <!-- End Navbar Area -->

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.body.footer')
    <!-- Footer Area End -->

    <!-- Jquery Min JS -->
    <script src="{{ asset('Frontend/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Bundle Min JS -->
    <script src="{{ asset('Frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Magnific Popup Min JS -->
    <script src="{{ asset('Frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Owl Carousel Min JS -->
    <script src="{{ asset('Frontend/assets/js/owl.carousel.min.js') }}"></script>
    <!-- Nice Select Min JS -->
    <script src="{{ asset('Frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Wow Min JS -->
    <script src="{{ asset('Frontend/assets/js/wow.min.js') }}"></script>
    <!-- Jquery Ui JS -->
    <script src="{{ asset('Frontend/assets/js/jquery-ui.js') }}"></script>
    <!-- Meanmenu JS -->
    <script src="{{ asset('Frontend/assets/js/meanmenu.js') }}"></script>
    <!-- Ajaxchimp Min JS -->
    <script src="{{ asset('Frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Form Validator Min JS -->
    <script src="{{ asset('Frontend/assets/js/form-validator.min.js') }}"></script>
    <!-- Contact Form JS -->
    <script src="{{ asset('Frontend/assets/js/contact-form-script.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('Frontend/assets/js/custom.js') }}"></script>
</body>

</html>
