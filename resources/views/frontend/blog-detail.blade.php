@extends('layouts.frontend')
@section('css')
    <style>

        .blog-details .post-img img{
            height: 450px !important;
            width: 100%;
              object-fit: cover;
        }
        .content img{
            max-width: 100% !important;
        }
    </style>

@endsection
@section('content')
<!-- Page Title -->
<div class="page-title">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Blog Details</h1>
            <p>Explore in-depth insights, expert opinions, and valuable information on trending topics. Stay informed and inspired with our latest blog updates.</p>
        </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.html">Home</a></li>
          <li class="current">Blog Details</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <div class="container">
    <div class="row">

      <div class="col-lg-9">

        <!-- Blog Details Section -->
        <section id="blog-details" class="blog-details section">
          <div class="container">

            <article class="article">

              <div class="post-img">
               <a target="_blank" href="{{ asset('storage/'. $blog->thumbnail ) }}"> <img  src="{{ asset('storage/'. $blog->thumbnail ) }}" alt="" class="img-fluid"></a>
              </div>

              <h2 class="title">{{ $blog->title }}</h2>

              <div class="meta-top">
                <ul>
                    @php
                    $admin = \App\Models\User::where('user_type', 'admin')->first();
                @endphp

                @if($admin)
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">{{ $admin->name }}</a></li>
                @else
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">Video | Editor</a></li>

                @endif
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time></a></li>

                </ul>
              </div><!-- End meta top -->

              <div class="content mt-5">

                {!! $blog->description !!}


              </div><!-- End post content -->




            </article>

          </div>
        </section><!-- /Blog Details Section -->





      </div>

      <div class="col-lg-3 sidebar">

        <div class="widgets-container">


          {{-- <div class="search-widget widget-item">

            <h3 class="widget-title">Search</h3>
            <form action="">
              <input type="text">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>

          </div> --}}

          <!-- Categories Widget -->
          <div class="categories-widget widget-item">

            <h3 class="widget-title">Categories</h3>
            <ul class="mt-3">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('category-blogs', $category->slug) }}">
                            {{ $category->name }} <span>({{ $category->blogs_count }})</span>
                        </a>
                    </li>
                @endforeach
            </ul>
          </div><!--/Categories Widget -->

          <!-- Recent Posts Widget -->
          <div class="recent-posts-widget widget-item">
            <h3 class="widget-title">Recent Posts</h3>

            @foreach($recentBlog as $rBlog)
                <div class="post-item d-flex">
                    <img src="{{ asset(path: 'storage/'.$rBlog->thumbnail) }}" alt="{{ $rBlog->title }}" class="flex-shrink-0" style="width: 70px; height: 70px; object-fit: cover;">
                    <div class="ms-3">
                        <h4>
                            <a href="{{ route('blog-details',$rBlog->slug) }}"
                               data-bs-toggle="tooltip"
                               title="{{ $rBlog->title }}">
                               {{ Str::limit($rBlog->title, 50, '...') }}
                            </a>
                        </h4>
                                                <time datetime="{{ $rBlog->created_at }}">{{ $rBlog->created_at->format('M d, Y') }}</time>
                    </div>
                </div><!-- End recent post item -->
            @endforeach
        </div><!-- /Recent Posts Widget -->


        </div>

      </div>

    </div>
  </div>
@endsection
