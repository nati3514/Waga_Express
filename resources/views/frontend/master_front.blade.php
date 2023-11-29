<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Waga DHL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/assets/lib/animate/animate.min.css') }} " rel="stylesheet">
    <link href="{{ asset('frontend/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href=" {{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/assets/css/style.css') }} " rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid py-2 d-none d-lg-flex">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="me-3"><i class="fa fa-map-marker-alt me-2"></i>22 Street, Addis Abeba, Ethiopia</small>
                    <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat 2:00am-11:00pm, Sun Closed</small>
                </div>

            </div>
        </div>

        @if (Route::has('login'))
            <div class="">
                @auth
                    <a href="{{ url('/home') }}" class="px-3">Home</a>
                @else
                    <a href="{{ route('login') }}" class="">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-3">Signup</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
    <!-- Topbar End -->
    <!-- Brand Start -->
    @include('frontend.brand')
    <!-- Brand End -->

    <!-- Navbar Start -->
    @include('frontend.navbar')
    <!-- Navbar End -->

    <!-- Carousel Start -->
    @include('frontend.carasoul')
    <!-- Carousel End -->

    <!-- About Start -->

    @include('frontend.about')
    <!-- About End -->

    <!-- Features Start -->
    {{-- @include('frontend.features') --}}

    <!-- Features End -->

    <!-- Features 2 Start -->
    {{-- @include('frontend.features2') --}}
    <!-- Features 2 End -->

    <!-- Video Modal Start -->

    {{-- @include('frontend.videomodal') --}}
    <!-- Video Modal End -->

    <!-- Service Start -->
    {{-- @include('frontend.services') {{-- @include('frontend.services') --}}
    <!-- Service End -->

    <!-- Appoinment Start -->

    {{-- @include('frontend.appointment') --}}
    <!-- Appoinment Start -->

    <!-- Team Start -->
    {{-- @include('frontend.team') --}}

    <!-- Team End -->

    <!-- Testimonial Start -->
    {{-- @include('frontend.testimonial') --}}

    <!-- Testimonial End -->

    <!-- Footer Start -->
    {{-- @include('frontend.footer') --}}

    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src=" {{ asset('frontend/assets/lib/wow/wow.min.js') }} "></script>
    <script src=" {{ asset('frontend/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/assets/js/main.js') }} "></script>
</body>

</html>
