@extends('layouts.admin')
@section('title', 'Create Role')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">Create Role</h3>
                <a href="{{ route('admin.roles.list') }}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter role name" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
