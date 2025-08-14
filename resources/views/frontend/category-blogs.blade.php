@extends('layouts.frontend')
@section('content')
<!-- Page Title -->
<div class="page-title">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Blog</h1>
                    <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                        voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi
                        ratione sint. Sit quaerat ipsum dolorem.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="/">Home</a></li>
                <li class="current">Blog</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<!-- Blog Posts Section -->
<section id="blog-posts" class="blog-posts section">

    <div class="container">
        <div class="row gy-4">

            @if($blogs->isNotEmpty())
            @foreach($blogs as $blog)
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <article>
                    <div class="post-img">
                        <img style="height: 300px;" src="{{ asset('storage/' . $blog->thumbnail) }}"
                            alt="{{ $blog->title }}" class="img-fluid w-100  object-fit-cover">
                    </div>
                    <p class="post-category">
                        {{ $blog->category->name ?? 'No Category' }}
                    </p>

                    <h2 class="title">
                        <a href="{{ route('blog-details',$blog->slug) }}">{{ Str::limit($blog->title, 60, '...') }} </a>
                    </h2>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/blog-section/user-image2.png') }}" alt=""
                            class="img-fluid post-author-img flex-shrink-0">
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
                                <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y')
                                    }}</time>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
            <div class="mt-5">
                {{ $blogs->links() }}
            </div>
            @else
            <p class="text-center text-muted">No blogs available at the moment.</p>
            @endif

        </div>
    </div>

</section>

@endsection
