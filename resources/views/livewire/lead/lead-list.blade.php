<div>
    <style>
        .sortable-header {
            cursor: pointer;
            user-select: none;
            transition: background-color 0.2s ease;
        }
        .sortable-header:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        .sort-icon {
            font-size: 14px;
            opacity: 0.7;
        }
        .sort-icon.active {
            opacity: 1;
            color: #fff;
        }
    </style>
    
    <div class="card">
        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <div>
                <h3 class="m-0 text-white h3">
                    @if($userRole === 'admin')
                        All Leads
                    @else
                        My Leads
                    @endif
                </h3>
                @if($sortField && $sortDirection)
                    <small class="text-light">
                        Sorted by: <strong>{{ ucfirst(str_replace('_', ' ', $sortField)) }}</strong> 
                        ({{ $sortDirection === 'asc' ? 'A-Z' : 'Z-A' }})
                    </small>
                @endif
                @if($userRole === 'agent')
                    <small class="text-light d-block">Showing only leads assigned to you</small>
                @endif
            </div>
            @if($userRole === 'admin')
                <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                    Create Lead
                </a>
            @endif
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>
                            <div class="d-flex align-items-center sortable-header" wire:click="sortBy('name')">
                                Name
                                <i class="sort-icon {{ $this->sortField === 'name' ? 'active' : '' }} {{ $this->getSortIcon('name') }} ms-1"></i>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex align-items-center sortable-header" wire:click="sortBy('email')">
                                Email
                                <i class="sort-icon {{ $this->sortField === 'email' ? 'active' : '' }} {{ $this->getSortIcon('email') }} ms-1"></i>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex align-items-center sortable-header" wire:click="sortBy('phone')">
                                Phone
                                <i class="sort-icon {{ $this->sortField === 'phone' ? 'active' : '' }} {{ $this->getSortIcon('phone') }} ms-1"></i>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex align-items-center sortable-header" wire:click="sortBy('status')">
                                Status
                                <i class="sort-icon {{ $this->sortField === 'status' ? 'active' : '' }} {{ $this->getSortIcon('status') }} ms-1"></i>
                            </div>
                        </th>
                        @if($userRole === 'admin')
                            <th>
                                <div class="d-flex align-items-center sortable-header" wire:click="sortBy('assigned_to')">
                                    Assigned To
                                    <i class="sort-icon {{ $this->sortField === 'assigned_to' ? 'active' : '' }} {{ $this->getSortIcon('assigned_to') }} ms-1"></i>
                                </div>
                            </th>
                        @endif
                        <th>
                            <div class="d-flex align-items-center sortable-header" wire:click="sortBy('created_at')">
                                Created
                                <i class="sort-icon {{ $this->sortField === 'created_at' ? 'active' : '' }} {{ $this->getSortIcon('created_at') }} ms-1"></i>
                            </div>
                        </th>
                        @if($userRole === 'admin')
                        <th>Action</th>
                        @endif
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
                            @if($userRole === 'admin')
                                <td>{{ $lead->user?->name ?? 'Not Assigned' }}</td>
                            @endif
                            <td>{{ $lead->created_at->format('M d, Y') }}</td>
                            @if($userRole === 'admin')
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
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $userRole === 'admin' ? '8' : '7' }}" class="text-center">
                                @if($userRole === 'agent')
                                    No leads assigned to you yet
                                @else
                                    No leads found
                                @endif
                            </td>
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
