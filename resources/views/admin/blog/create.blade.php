@extends('layouts.admin')
@push('css')
<style>
    .ck.ck-editor__main>.ck-editor__editable {
        min-height: 300px !important;
        max-height: 400px;
        overflow-y: auto;
    }
</style>

@endpush

@section('content')
<div class="row">
    <div class="col-12">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </div>
    <div class="card">
        <div class="card-header bg-dark h4 d-flex justify-content-between " style="margin-bottom: 49px;">
            <h3 class="text-white">Blog Create( <span style="font-size: 18px;">{{ $category->slug }}</span> )</h3>
            <div>
                <a class="btn btn-primary" href="{{ route('admin.blogs.categories') }}">Back</a>
                <a class="btn btn-info" href="{{ route('admin.blog.list',$category->id) }}">Blog list</a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-xs-12">
                <form action="{{ route('admin.blog.store',$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="category_id" value="{{ $category->id }}" hidden>
                    <div class="row">
                        @if (session('success'))
                        <div class="col-xs-12">
                            <div class="alert alert-success">{{ session('success') }}</div>
                        </div>
                        @endif

                        <!-- Title Input -->
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group mb-4">
                                <label class="form-label" for="title">Enter Blog Title</label>
                                <textarea id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    cols="30" rows="2">{{ old('title') }}</textarea>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Subtitle Input -->
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group mb-4">
                                <label class="form-label" for="sub_title">Enter Blog Subtitle</label>
                                <textarea id="sub_title" name="sub_title"
                                    class="form-control @error('sub_title') is-invalid @enderror"
                                    cols="30" rows="2">{{ old('sub_title') }}</textarea>
                                @error('sub_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Thumbnail Input -->
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group mb-4">
                                <label class="form-label" for="thumbnail">Thumbnail</label>
                                <input id="thumbnail" name="thumbnail" type="file"
                                    class="form-control @error('thumbnail') is-invalid @enderror">
                                @error('thumbnail')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="editor">{!! old('description') !!}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mt-3 text-end">
                            <button type="reset" class="btn btn-dark btn-lg btn-block">Reset</button>
                            <button  onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> {{ ('Please wait...') }}';" type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

<script>

    ClassicEditor

        .create( document.querySelector( '#editor' ),{

            ckfinder: {
                uploadUrl: '{{route('admin.ckeditor.upload').'?_token='.csrf_token()}}',
            }
        })

        .catch( error => {
        } );

</script>

@endpush
