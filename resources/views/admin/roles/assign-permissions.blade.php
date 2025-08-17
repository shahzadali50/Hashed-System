@extends('layouts.admin')
@section('title', 'Assign Permissions to Role')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">Assign Permissions to Role: <span class="text-warning">{{ $role->name }}</span></h3>
                <a href="{{ route('admin.roles.list') }}" class="btn btn-primary">Back to Roles</a>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.roles.permissions.update', $role->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-3">Select Permissions for this Role:</h5>

                            @if($permissions->count() > 0)
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-6 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                       id="permission_{{ $permission->id }}"
                                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    <strong>{{ $permission->name }}</strong>
                                                    <small class="text-muted d-block">ID: {{ $permission->id }}</small>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No permissions found. Please create some permissions first.
                                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary ms-2">Create Permission</a>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Role Information</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Role Name:</strong> {{ $role->name }}</p>
                                    <p><strong>Created:</strong> {{ $role->created_at->format('M d, Y') }}</p>
                                    <p><strong>Current Permissions:</strong> {{ count($rolePermissions) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-check me-1"></i>
                            Update Role Permissions
                        </button>
                        <a href="{{ route('admin.roles.list') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
