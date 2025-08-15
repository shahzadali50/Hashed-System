<div>
    <div class="card">
        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h3 class="m-0 text-white">Leads List</h3>
            <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                Create Lead
            </a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lead->name }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->phone }}</td>
                            <td>
                                <span class="badge bg-{{ ['new' => 'primary', 'contacted' => 'warning', 'closed' => 'success'][$lead->status] ?? 'secondary' }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </td>
                            <td>{{ $lead->user?->name ?? 'Not Assigned' }}</td>
                            <td>{{ $lead->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.leads.edit', $lead->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.leads.delete', $lead->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this lead?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No leads found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $leads->links() }}
            </div>
        </div>
    </div>

</div>
