<header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:info@example.com">info@example.com</a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <span>+1 5589 55488 55</span>
                </i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                <a href="#" target="_blank" class="linkedin"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img style="max-width: 200px;" class="img-thumbnail" src="{{ url('assets/img/website_apperance/default-header_logo.jpg') }}" alt="Header Logo Preview" />
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/" class="active">Home<br></a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#services">Services</a></li>

                    @guest
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    @else
                        <li><a href="/dashboard">Dashboard</a></li>
                    @endguest
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
