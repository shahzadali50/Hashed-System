@extends('layouts.admin')
@section('title', 'Permission Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">Permission: <span class="text-warning">{{ $permission->name }}</span></h3>
                <a href="{{ route('admin.permissions.list') }}" class="btn btn-primary">Back to Permissions</a>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Permission Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $permission->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Guard:</strong></td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $permission->created_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $permission->updated_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Roles with this Permission</h5>
                        @if($roles->count() > 0)
                            <div class="list-group">
                                @foreach($roles as $role)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $role->name }}</h6>
                                            <small class="text-muted">Role ID: {{ $role->id }}</small>
                                        </div>
                                        <a href="{{ route('admin.roles.permissions', $role->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Manage Permissions
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                No roles currently have this permission assigned.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-warning">
                        <i class="mdi mdi-pencil me-1"></i>
                        Edit Permission
                    </a>
                    <a href="{{ route('admin.permissions.list') }}" class="btn btn-secondary ms-2">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
