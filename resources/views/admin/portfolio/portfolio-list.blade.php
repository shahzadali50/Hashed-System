@extends('layouts.admin')
@push('css')
<style>

</style>

@endpush

@section('content')
<div class="row">
   <div class="col-lg-10">
    <div class="card">
        <div class="card-header border-b h4 d-flex justify-content-between border-double" style="margin-bottom: 49px;">
            <div>
                <h3 class="m-0 ">Portfolio List  (<span class="text-secondary">{{ $category->slug }}</span>)</h3>

            </div>

            <div>
                <a class="btn btn-primary" href="{{ route('admin.portfolio.categories') }}">Back</a>
                <a class="btn btn-primary" href="{{ route('admin.create-portfolio',$category->id) }}">Add Portfolio</a>
            </div>
        </div>
        <div class="card-datatable text-nowrap px-3">
            @if($portfolios->isEmpty())
                <div class="alert alert-warning text-center mt-3">
                    No portfolio found.
                </div>

            @else
                <table class="table table-striped dataTable">
                    <thead>
                        <tr class="">
                            <th scope="col">ID</th>
                            <th scope="col">Portfolio Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($portfolios as $portfolio)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $portfolio->image) }}" width="50" height="50" alt="Portfolio Image">
                            </td>
                            <td>{{ $portfolio->title ? $portfolio->title : 'Not Added' }}</td>
                            <td>{{ strlen($portfolio->description ?? '') > 30 ? substr($portfolio->description, 0, 30) . '...' : ($portfolio->description ?? 'Not Added') }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('admin.portfolio.delete',$portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <a href="{{ route('admin.portfolio-edit',$portfolio->id) }}" class="btn btn-info mx-1">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $portfolios->links() }}  <!-- Laravel Pagination -->
                    </div>
            @endif
        </div>
    </div>

   </div>
</div>
@endsection

@push('css')

@endpush



