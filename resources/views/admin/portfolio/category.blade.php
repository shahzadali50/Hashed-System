@extends('layouts.admin')
@push('css')
<style>

</style>

@endpush

@section('content')
<div class="row">
   <div class="col-lg-7">
    <div class="card">
        <div class="card-header bg-dark h4 " style="margin-bottom: 49px;">
            <h3 class="m-0 text-white">Categories List</h3>

        </div>
        <div class="card-datatable text-nowrap px-3">
            @if($categories->isEmpty())
                <div class="alert alert-warning text-center mt-3">
                    No categories found.
                </div>
            @else
                <table class="table table-striped dataTable">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('admin.portfolio.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.category.edit',$category->id) }}" class="btn btn-info btn-sm mx-1" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="{{ route('admin.create-portfolio',$category->id) }}" class="btn btn-success btn-sm mx-1" data-bs-toggle="tooltip" title="Add Portfolio">
                                        <i class="fa fa-plus"></i>
                                    </a>

                                    <a href="{{ route('admin.portfolio-list',$category->id) }}" class="btn btn-primary btn-sm mx-1" data-bs-toggle="tooltip" title="Portfolio List">
                                        <i class="fa fa-list"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

   </div>
   <div class="col-lg-5">
    <div class="card">
        <div class="card-header border-bottom">
            <h6 class="mb-0">Add Category</h6>
        </div>
        <div class="card-body mt-5">

            <form action="{{ route('admin.portfolio.categories.store') }}" method="POST">
                @csrf
                   <!-- Facebook Link -->
                   <div class="form-group row mb-2">
                    <div class="col-md-3">
                        <label class="col-form-label">Category Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ old('name') }}" name="name" placeholder="Category Name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="col-12 text-end mt-4">
                    <button onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Please wait...';" type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

   </div>
</div>
@endsection

@push('css')

@endpush



