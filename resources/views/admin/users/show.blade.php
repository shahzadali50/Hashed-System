@extends('layouts.admin')
@section('title', 'User Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">User Details: <span class="text-warning">{{ $user->name }}</span></h3>
                <a href="{{ route('admin.users.list') }}" class="btn btn-primary">Back to Users</a>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">User Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email Verified:</strong></td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                        <small class="text-muted d-block">{{ $user->email_verified_at->format('M d, Y H:i:s') }}</small>
                                    @else
                                        <span class="badge bg-warning">Not Verified</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $user->created_at->format('M d, Y H:i:s') }}</td>
                            </tr>

                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Assigned Roles</h5>
                        @if($user->roles->count() > 0)
                            <div class="list-group">
                                @foreach($user->roles as $role)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $role->name }}</h6>
                                            <small class="text-muted">Role ID: {{ $role->id }}</small>
                                        </div>
                                        <a href="{{ route('admin.roles.permissions', $role->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            View Permissions
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                No roles assigned to this user.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    @can('edit users')
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                        <i class="mdi mdi-pencil me-1"></i>
                        Edit User
                    </a>
                    @endcan
                    @can('delete users')

                    @if(Auth::id() !== $user->id)
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="mdi mdi-delete me-1"></i>
                                Delete User
                            </button>
                        </form>
                    @else
                        <span class="text-muted ms-2">(Cannot delete your own account)</span>
                    @endif
                    @endcan
                    <a href="{{ route('admin.users.list') }}" class="btn btn-secondary ms-2">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
