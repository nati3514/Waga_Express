<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - Admin Bootstrap Template</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="https://fonts.gstatic.com" rel="preconnect">

    {{-- toaster link belowe --}}

    {{-- //////////////////////////////below are offline assets ///////////////////////////////////////////////// --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('backend/assets/img/favicon.png') }} " rel="icon">
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }} " rel="apple-touch-icon">
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/bootstrap-icons.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/boxicons.min.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/quill.snow.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/quill.bubble.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/remixicon.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/simple-datatables.css') }} " rel="stylesheet">
    <link href="{{ asset('backend/assets/css/style.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" > --}}
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
        {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link href="{{ asset('backend/assets/css/search.css') }} " rel="stylesheet">
</head>

<body>
    @include('admin.body.header')

    @include('admin.body.sidebar')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @yield('main')

    @include('admin.body.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="{{ asset('backend/assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart.min.js') }} "></script>
    <script src="{{ asset('backend/assets/js/echarts.min.js') }} "></script>
    <script src="{{ asset('backend/assets/js/quill.min.js') }} "></script>
    <script src="{{ asset('backend/assets/js/simple-datatables.js') }} "></script>
    <script src="{{ asset('backend/assets/js/tinymce.min.js') }} "></script>
    <script src="{{ asset('backend/assets/js/validate.js') }} "></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
