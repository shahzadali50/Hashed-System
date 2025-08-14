
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('components.partials.frontend.head')
@yield('css')

<body class="index-page">
@include('components.partials.frontend.header')



<main class="main">
@yield('content')



</main>

@include('components.partials.frontend.footer')

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>
@include('components.partials.frontend.foot')
@include('components.partials.frontend.script')
@yield('script')
</body>

</html>
