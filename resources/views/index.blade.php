@extends('layouts.frontend')
@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section accent-background ">

    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-5 justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            @php
            $banner_title = business_setting('banner_title');
            $banner_description = business_setting('banner_description');
            $banner_youtube_link = business_setting('banner_youtube_link');
            $banner_image = business_setting('banner_image');
            @endphp
            @if($banner_title)
                <h1>{{ $banner_title }}</h1>
            @else
                <h2>Not Added Banner Title</h2>
            @endif
            @if($banner_description)
                <p>{{ $banner_description }}</p>
            @else
                <p>Not Added Banner Description</p>
            @endif
          <div class="d-flex">
            <a href="#about" class="btn-get-started">Get Started</a>
            @if($banner_youtube_link)
            <a href="{{ $banner_youtube_link }}" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        @else

        @endif
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2">
            @if($banner_image)
                <img src="{{ asset('storage/' . $banner_image) }}" class="img-fluid" alt="not-show">
            @else
                <img src="{{ asset('assets/img/hero-img.svg') }}" class="img-fluid" alt="not-show">
            @endif
        </div>
      </div>
    </div>



  </section><!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>About Us<br></h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <h3>Voluptatem dignissimos provident laboris nisi ut aliquip ex ea commodo</h3>
          <img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
          <p>Ut fugiat ut sunt quia veniam. Voluptate perferendis perspiciatis quod nisi et. Placeat debitis quia recusandae odit et consequatur voluptatem. Dignissimos pariatur consectetur fugiat voluptas ea.</p>
          <p>Temporibus nihil enim deserunt sed ea. Provident sit expedita aut cupiditate nihil vitae quo officia vel. Blanditiis eligendi possimus et in cum. Quidem eos ut sint rem veniam qui. Ut ut repellendus nobis tempore doloribus debitis explicabo similique sit. Accusantium sed ut omnis beatae neque deleniti repellendus.</p>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
          <div class="content ps-0 ps-lg-5">
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
            </ul>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
            </p>

            <div class="position-relative mt-4">
              <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section><!-- /About Section -->

  <!-- Clients Section -->
  <section id="clients" class="clients section">

    <div class="container">

      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
        </div>
      </div>

    </div>

  </section><!-- /Clients Section -->

  <!-- Stats Section -->
  <section id="stats" class="stats section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 align-items-center">

        <div class="col-lg-5">
          <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
        </div>

        <div class="col-lg-7">

          <div class="row gy-4">

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-emoji-smile flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Happy Clients</strong> <span>consequuntur quae</span></p>
                </div>
              </div>
            </div> 

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-journal-richtext flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Projects</strong> <span>adipisci atque cum quia aut</span></p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-headset flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Hours Of Support</strong> <span>aut commodi quaerat</span></p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-people flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Hard Workers</strong> <span>rerum asperiores dolor</span></p>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>

  </section><!-- /Stats Section -->



  <!-- Services Section -->
  <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Our Services</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item  position-relative">
            <div class="icon">
              <i class="bi bi-activity"></i>
            </div>
            <h3>Nesciunt Mete</h3>
            <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
            <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-broadcast"></i>
            </div>
            <h3>Eosle Commodi</h3>
            <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
            <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-easel"></i>
            </div>
            <h3>Ledo Markt</h3>
            <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
            <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-bounding-box-circles"></i>
            </div>
            <h3>Asperiores Commodit</h3>
            <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
            <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-calendar4-week"></i>
            </div>
            <h3>Velit Doloremque</h3>
            <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
            <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-chat-square-text"></i>
            </div>
            <h3>Dolori Architecto</h3>
            <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
            <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>

  </section><!-- /Services Section -->

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Showcasing creative projects and innovative work, crafted with passion and precision.</p>

    </div><!-- End Section Title -->

    <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <!-- Portfolio Filters -->
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                @foreach(get_portfolio_categories() as $category)
                    <li data-filter=".filter-{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                @endforeach
            </ul>

            <!-- Portfolio Items -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach(get_portfolio_categories() as $category)
                    @foreach($category->portfolios as $portfolio)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($category->name) }}">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('storage/'.$portfolio->image) }}" data-gallery="portfolio-gallery-{{ Str::slug($category->name) }}" class="glightbox">
                                    <img style="height: 260px" src="{{ asset('storage/'.$portfolio->image) }}" class="img-fluid object-fit-cover w-100" alt="{{ $portfolio->title }}">
                                </a>
                                <div class="portfolio-info">
                                    <h4><a href="script:void(0)" title="More Details">{{ $portfolio->title ?? '' }}</a></h4>
                                    <p title="{{ $portfolio->description }}">{{ Str::limit($portfolio->description, 30, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div><!-- End Portfolio Container -->

        </div>


    </div>

  </section>

  <!-- Recent Posts Section -->
  <section id="recent-posts" class="recent-posts section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Recent Blog Posts</h2>
      <p>Stay updated with insightful blogs on the latest trends, tips, and ideas. Explore a world of knowledge and inspiration in just a click!</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

        @php
        $blogs = get_blogs(6); // Fetch latest 3 blogs
    @endphp

    @if($blogs->isNotEmpty())
        @foreach($blogs as $blog)
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <article>
                    <div class="post-img">
                        <img  style="height: 300px;"  src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid w-100  object-fit-cover">
                    </div>
                    <p class="post-category">
                        {{ $blog->category->name ?? 'No Category' }}
                    </p>

                    <h2 class="title">
                        <a href="{{ route('blog-details',$blog->slug) }}">{{ Str::limit($blog->title, 60, '...') }} </a>
                    </h2>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/blog-section/user-image2.png') }}" alt="" class="img-fluid post-author-img flex-shrink-0">
                        <div class="post-meta">
                            @php
                            $admin = \App\Models\User::where('user_type', 'admin')->first();
                        @endphp

                        @if($admin)
                            <p class="post-author">{{ $admin->name }}</p>
                        @else
                            <p class="post-author">Video | Editor</p>
                        @endif
                        <p class="post-date">
                                <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    @else
        <p class="text-center text-muted">No blogs available at the moment.</p>
    @endif




      </div><!-- End recent posts list -->

    </div>

  </section><!-- /Recent Posts Section -->

  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact us</h2>
        <p>Get in touch with us for inquiries, collaborations, or support. We're here to help!</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gx-lg-0 gy-4">

        <div class="col-lg-4">
          <div class="info-container d-flex flex-column align-items-center justify-content-center">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                    <h3>Address</h3>
                    <p>{{ business_setting('address') ?? 'Lahore,Pakistan' }}</p>
                </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                    <h3>Call Us</h3>
                    <p>{{ business_setting('phone_number') ?? '+1 000 000 0000' }}</p>
                </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                    <h3>Email Us</h3>
                    <p>{{ business_setting('email') ?? 'masoodmansha@gmail.com' }}</p>
                </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-clock flex-shrink-0"></i>
              <div>
                <h3>Open Hours:</h3>
                <p>Mon-Sat: 7/24</p>
              </div>
            </div><!-- End Info Item -->

          </div>

        </div>

        <div class="col-lg-8">
            @livewire('contact-us')

        </div>

      </div>

    </div>

  </section><!-- /Contact Section -->

@endsection
