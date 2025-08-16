@extends('layouts.admin')
@section('title', 'Roles')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">Roles List</h3>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Role</a>
            </div>
            <div class="card-body table-responsive">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                                <br>
                                <small class="text-muted">
                                    @if($role->permissions->count() > 0)
                                        {{ $role->permissions->take(3)->pluck('name')->implode(', ') }}
                                        @if($role->permissions->count() > 3)
                                            +{{ $role->permissions->count() - 3 }} more
                                        @endif
                                    @else
                                        No permissions assigned
                                    @endif
                                </small>
                            </td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('admin.roles.permissions',$role->id) }}" class="btn btn-sm btn-info">Permissions</a>
                                <form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No roles found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $roles->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
