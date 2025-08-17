@extends('layouts.admin')
@section('title', 'Permissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-white h3">Permissions List</h3>
                @can('create permissions')
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Create Permission</a>
                @endcan
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
                            <th>Roles</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $permission->roles->count() }} roles</span>
                                <br>
                                <small class="text-muted">
                                    @if($permission->roles->count() > 0)
                                        {{ $permission->roles->take(3)->pluck('name')->implode(', ') }}
                                        @if($permission->roles->count() > 3)
                                            +{{ $permission->roles->count() - 3 }} more
                                        @endif
                                    @else
                                        No roles assigned
                                    @endif
                                </small>
                            </td>
                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                            <td>
                                @can('view permissions')
                                    <a href="{{ route('admin.permissions.show',$permission->id) }}" class="btn btn-sm btn-info">View</a>
                                @endcan
                                @can('edit permissions')
                                    <a href="{{ route('admin.permissions.edit',$permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                @endcan
                                @can('delete permissions')
                                    <form action="{{ route('admin.permissions.destroy',$permission->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No permissions found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $permissions->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
