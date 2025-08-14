@extends('layouts.admin')
@push('css')
<style>
    .blog_content img{
        max-width: 70% !important;
    }

</style>

@endpush

@section('content')
<div class="card">
    <div class="card-header bg-dark h4 d-flex justify-content-between mb-5">
        <h3 class="text-white">Blog View ( <span style="font-size: 18px;">{{ $blog->category->slug}}</span> )</h3>
        <div>
            <a class="btn btn-primary btn-lg" href="{{ route('admin.blog.list',$blog->category->id) }}">Back</a>
           </div>
    </div>
    <div class="card-body">
        <div class="col-xs-12">

            @if ($blog->thumbnail)
            <h4>Thumbnail Image</h4>
            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="Thumbnail" style="max-width: 150px; max-height: 150px;">
            @else
            <p>No Thumbnail</p>
            @endif

            <h4 class="mt-2">Blog Title:</h4>
            <p>{{ $blog->title }}</p>


            <h4 class="mt-3">Blog Sub Title:</h4>
            <p>{{ $blog->sub_title }}</p>

            <div>
                <h4>Blog Description:</h4>
                <div class="blog_content">

                    {!! $blog->description !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



