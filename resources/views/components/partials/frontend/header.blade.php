<header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                @php
                $email = business_setting('email') ?? null;
            @endphp

            @if($email)
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                </i>
            @else
                <span>masoodmansha@gmail.com</span>
            @endif
                @php
                    $phone_number = business_setting('phone_number');
                @endphp

                @if($phone_number)
                    <i class="bi bi-phone d-flex align-items-center ms-4">
                        <span>{{ $phone_number }}</span>
                    </i>
                @else
                    <i class="bi bi-phone d-flex align-items-center ms-4">
                        <span>03163863461</span>
                    </i>
                @endif            </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    @php
                        $facebook_link = business_setting('facebook_link');
                        $twitter_link = business_setting('twitter_link');
                        $instagram_link = business_setting('instagram_link');
                        $Linkedin_link = business_setting('Linkedin_link');
                        $youtube_link = business_setting('youtube_link');
                    @endphp

                    @if($twitter_link)
                        <a href="{{ $twitter_link }}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                    @endif

                    @if($facebook_link)
                        <a href="{{ $facebook_link }}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                    @endif

                    @if($instagram_link)
                        <a href="{{ $instagram_link }}" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                    @endif

                    @if($Linkedin_link)
                        <a href="{{ $Linkedin_link }}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if($youtube_link)
                        <a href="{{ $youtube_link }}" target="_blank" class="linkedin"><i class="bi bi-youtube"></i></a>
                    @endif
                </div>

        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                @php
                $headerLogo = business_setting('header_logo');
                @endphp
                @if ($headerLogo)
                <!-- Check if the logo path exists -->
                <img style="max-width: 200px;" class="img-thumbnail " src="{{ asset('storage/' . $headerLogo) }}" alt="Header Logo Preview" />
                @else
                <img style="max-width: 200px;" class="img-thumbnail" src="{{ url('assets/img/website_apperance/default-header_logo.jpg') }}" alt="Header Logo Preview" />

                @endif
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/" class="active">Home<br></a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>

                    <li ><a  href="{{ route('blogs') }}">Blogs</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Deep Dropdown 1</a></li>
                    <li><a href="#">Deep Dropdown 2</a></li>
                    <li><a href="#">Deep Dropdown 3</a></li>
                    <li><a href="#">Deep Dropdown 4</a></li>
                    <li><a href="#">Deep Dropdown 5</a></li>
                  </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
              </ul>
            </li> --}}
                    <li><a href="{{ route('contact-us') }}">Contact us</a></li>
                    @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endauth
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
