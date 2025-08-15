<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    @php
    $site_icon = business_setting('site_icon');
@endphp
    @if ($site_icon) <!-- Check if the logo path exists -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $site_icon) }}" />
@else
<link rel="icon" type="image/x-icon" href="{{ url('assets/img/website_apperance/default-site-icon.svg') }}" />
@endif
    <link rel="icon" type="image/x-icon" href="{{ url('assets/images/header-newlogo.PNG') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{url('admin/assets/vendor/fonts/materialdesignicons.css')}}" />
    {{-- <link rel="stylesheet" href="{{url('admin/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/fonts/flag-icons.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/fonts/remixicon.css')}}" />
    <!-- font-awesome --> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('admin/assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/css/demo.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/dropzone/dropzone.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/swiper/swiper.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/libs/quill/editor.css') }}" />
    {{-- datatabel css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{url('admin/assets/vendor/css/pages/cards-statistics.css')}}" />
    <link rel="stylesheet" href="{{url('admin/assets/vendor/css/pages/cards-analytics.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <!-- Helpers -->
    <script src="{{url('admin/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{url('admin/assets/vendor/js/template-customizer.js')}}"></script>
    <script src="{{url('admin/assets/js/config.js')}}"></script>
    {{-- @vite(['resources/js/app.js','resources/js/echo.js']) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/echo.js'])
    @livewireStyles
    <title>@yield('title')</title>
    <style>
        .fl-wrapper{
            z-index: +99999 !important;
        }
        body {
            font-family: "Inter", sans-serif;
        }

        .form-label {
            font-weight: 600;
            font-size: 15px;
        }

        .light-style .menu .app-brand.demo {
            height: 103px;
        }


        /* .bg-menu-theme .menu-item.active>.menu-link:not(.menu-toggle) {
            background-color: #FF6B00;
        } */

        /* .bg-primary {
            background-color: #FF6B00 !important;
            color: #ffffff;
        } */

        /* .btn-primary {
            background-color: #FF6B00;
            border-color: #FF6B00;
        } */

        /* .btn-primary:hover {
            background-color: #FEB900;
            border-color: #FEB900;
        } */

        /* .text-primary {
            color: #FF6B00 !important;
        } */
         .active-chat-user{
            background-color: #dfdddd !important;
         }

    </style>
    @stack('css')
</head>
