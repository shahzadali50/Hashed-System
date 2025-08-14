@extends('layouts.admin-app')

@section('content')
<div class="card">
    <div class="card-header bg-dark h4 d-flex justify-content-between mb-5">
        <h3 class="text-white">Blog View</h3>
        <div>
            <a class="btn btn-primary" href="{{ route('blog.list') }}">Back</a>
           </div>
    </div>
    <div class="card-body">
        <div class="col-xs-12">
            <h4>Blog category:</h4>
            <p>{{ $blog_show->category->name }}</p>

            @if ($blog_show->thumbnail)
            <p>Thumbnail Image</p>
            <img src="{{ asset('storage/' . $blog_show->thumbnail) }}" alt="Thumbnail" style="max-width: 150px; max-height: 150px;">
            @else
            <p>No Thumbnail</p>
            @endif

            <h4 class="mt-2">Blog Title:</h4>
            <p>{{ $blog_show->title }}</p>


            <h4 class="mt-3">Blog Title Content:</h4>
            <p>{{ $blog_show->title_content }}</p>

            <div>
                <h4>Blog Description:</h4>
                {!! $blog_show->description !!}
            </div>
        </div>
    </div>
</div>

@endsection



