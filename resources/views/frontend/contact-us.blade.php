@extends('layouts.frontend')
@section('content')
<!-- Page Title -->
<div class="page-title">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Contact us</h1>
                    <p class="mb-0">Get in touch with us for inquiries, collaborations, or support. We're here to help!</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="/">Home</a></li>
                <li class="current">Contact us</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

 <!-- Contact Section -->
 <section id="contact" class="contact section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact us</h2>
    </div>

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
