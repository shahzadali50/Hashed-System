
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ business_setting('website_name') ?? 'Video | Editor' }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    @php
    $site_icon = business_setting('site_icon');
@endphp
    @if ($site_icon) <!-- Check if the logo path exists -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' .$site_icon) }}" />
@else
<link rel="icon" type="image/x-icon" href="{{ url('assets/img/website_apperance/default-site-icon.svg') }}" />
@endif

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ url('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ url('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ url('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ url('assets/css/main.css') }}" rel="stylesheet">
@livewireStyles

<style>
    .header .logo img {
    max-height: 50px !important;
}
.is-invalid {
    border: 1px solid red !important;
}
.fl-wrapper{
            z-index: +99999 !important;
        }
        .hero .container{
            max-width: 1500px;
        }
        .hero .row{
            padding-top: 70px;
            padding-bottom: 70px;
        }
</style>


</head>
