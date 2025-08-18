@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">Users List</h3>
                @can('create users')

                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create User</a>
                @endcan
            </div>
            <div class="card-body table-responsive">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->roles->count() > 0)
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-info me-1 mb-1">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No roles assigned</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                @can('view users')
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info m-1">View</a>
                                @endcan

                                @can('edit users')
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning m-1">Edit</a>
                                @endcan

                                @if(Auth::id() !== $user->id && !$user->hasRole('super_admin'))
                                @can('delete users')
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger m-1" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                                @endcan
                                @elseif(Auth::id() === $user->id)
                                    <span class="text-danger">Current User</span>
                                @elseif($user->hasRole('super_admin'))
                                    <span class="text-warning">Super Admin (Protected)</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center">No users found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
