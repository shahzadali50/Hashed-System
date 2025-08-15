<div>
    <div class="card">
        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h3 class="m-0 text-white">Leads List</h3>
            <button wire:click="resetForm" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLeadModal">
                Create Lead
            </button>
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
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button wire:click="deleteLead({{ $lead->id }})" wire:confirm="Are you sure you want to delete this lead?" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
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

    <div wire:ignore.self class="modal fade" id="createLeadModal" tabindex="-1" aria-labelledby="createLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLeadModalLabel">Create Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="createLead" id="createLeadForm">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Lead Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter lead name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" wire:model="email" id="email" class="form-control" placeholder="Enter email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" wire:model="phone" id="phone" class="form-control" placeholder="Enter phone">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select wire:model="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    @foreach(['new' => 'New', 'contacted' => 'Contacted', 'closed' => 'Closed'] as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="assigned_to" class="form-label">Assign To</label>
                                <select wire:model="assigned_to" id="assigned_to" class="form-control">
                                    <option value="">Select User</option>
                                    @foreach($users as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('assigned_to') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="notes" class="form-label">Notes <span class="text-danger">*</span></label>
                                <textarea wire:model="notes" id="notes" class="form-control" rows="4" placeholder="Enter notes"></textarea>
                                @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove wire:target="createLead">Create Lead</span>
                                    <span wire:loading wire:target="createLead">
                                        Please wait
                                        <div class="spinner-border spinner-border-sm text-light ms-2" role="status"></div>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Reset form inputs and close modal when modal is hidden
    document.getElementById('createLeadModal').addEventListener('hidden.bs.modal', () => {
        document.getElementById('createLeadForm').reset();
        @this.resetForm();
    });

    // Reset form inputs when reset-form event is dispatched
    window.addEventListener('reset-form', () => {
        document.getElementById('createLeadForm').reset();
    });

    // Close modal when close-modal event is dispatched
    window.addEventListener('close-modal', () => {
        const modal = document.getElementById('createLeadModal');
        const bootstrapModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
        bootstrapModal.hide();
    });
</script>
