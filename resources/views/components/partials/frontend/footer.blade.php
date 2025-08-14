<footer id="footer" class="footer accent-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Impact</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            @if(business_setting('twitter_link'))
                <a href="{{ business_setting('twitter_link') }}" target="_blank"><i class="bi bi-twitter"></i></a>
            @endif
            @if(business_setting('facebook_link'))
                <a href="{{ business_setting('facebook_link') }}" target="_blank"><i class="bi bi-facebook"></i></a>
            @endif
            @if(business_setting('instagram_link'))
                <a href="{{ business_setting('instagram_link') }}" target="_blank"><i class="bi bi-instagram"></i></a>
            @endif
            @if(business_setting('Linkedin_link'))
                <a href="{{ business_setting('Linkedin_link') }}" target="_blank"><i class="bi bi-linkedin"></i></a>
            @endif
            @if(business_setting('youtube_link'))
            <a href="{{ business_setting('youtube_link') }}" target="_blank"><i class="bi bi-youtube"></i></a>
        @endif
        </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Company</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Blogs</a></li>
            <li><a href="#">Contact us</a></li>
            {{-- <li><a href="#">Terms of service</a></li> --}}
            {{-- <li><a href="#">Privacy policy</a></li> --}}
          </ul>
        </div>


        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>{{ business_setting('address') ?? 'A108 Adam Street' }}</p>
            <p class="mt-4"><strong>Phone:</strong> <span>{{ business_setting('phone_number') ?? '+1 5589 55488 55' }}</span></p>
            <p><strong>Email:</strong> <span>{{ business_setting('email') ?? 'info@example.com' }}</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© {{ date('Y') }} <span>Copyright</span> <strong class="px-1 sitename">{{ business_setting('website_name') ?? 'Video | Editor' }}</strong> <span>All Rights Reserved</span> </p>

    </div>

  </footer>
