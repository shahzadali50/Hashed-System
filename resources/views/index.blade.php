@extends('layouts.frontend')
@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section ">

    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-5 justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>Welcome to Our Mini CRM</h1>
            <p>We provide innovative solutions for your business needs. Get started today and discover how we can help you grow.</p>
          <div class="d-flex">
            <a href="#about" class="btn-get-started">Get Started</a>

          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2">
            <img src="{{ asset('assets/img/hero-img.svg') }}" class="img-fluid" alt="Hero Image">
        </div>
      </div>
    </div>

  </section><!-- /Hero Section -->

@endsection
