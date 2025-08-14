@extends('layouts.admin')
@push('css')
<style>

</style>

@endpush

@section('content')
<div class="row">

   <div class="col-lg-5">
    <div class="card">
        <div class="card-header border-bottom">
            <h6 class="mb-0">Edit Category</h6>
        </div>
        <div class="card-body mt-5">

            <form action="{{ route('admin.category.update',$category->id) }}" method="POST">
                @csrf
                @method('PUT')
                   <!-- Facebook Link -->
                   <div class="form-group row mb-2">
                    <div class="col-md-3">
                        <label class="col-form-label">Category Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{  old('name', $category->name) }}" name="name" placeholder="Category Name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="col-12 text-end mt-4">
                    <a class="btn btn-info" href="{{ route('admin.portfolio.categories') }}">Back</a>

                    <button onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Please wait...';" type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

   </div>
</div>
@endsection

@push('css')

@endpush



