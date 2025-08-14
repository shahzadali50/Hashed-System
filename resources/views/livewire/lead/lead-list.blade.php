<div>
    <div class="card">
        <div class="card-header bg-dark h4 d-flex justify-content-between align-items-center" style="margin-bottom: 49px;">
            <h3 class="m-0 text-white">Leads List</h3>
            <button wire:click="openCreateModal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLeadModal">
                Create Lead
            </button>
        </div>
        <div class="card-datatable text-nowrap px-5 table-responsive">
            <table class="table table-striped ">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Created_at</th>
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
                                <span class="badge bg-{{ [
                                    'new' => 'primary',
                                    'contacted' => 'warning',
                                    'closed' => 'success'][$lead->status] ?? 'secondary' }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </td>
                            <td>{{ $lead->user->name ?? 'Not Assigned' }}</td>
                            <td>{{ $lead->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button wire:click="deleteLead({{ $lead->id }})"
                                        wire:confirm="Are you sure you want to delete this lead?"
                                        class="btn btn-sm btn-danger">
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
                {{  $leads->links() }}
               </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="createLeadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Lead</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="createLead" >
                    <div class="row gy-4">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Lead Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter lead name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" wire:model="email" id="email" class="form-control" placeholder="Enter email address">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" wire:model="phone" id="phone" class="form-control" placeholder="Enter phone number">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="new">New</option>
                                <option value="contacted">Contacted</option>
                                <option value="closed">Closed</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Assigned To Field -->
                        <div class="col-md-12">
                            <label for="assigned_to" class="form-label">Assign To</label>
                            <select wire:model="assigned_to" id="assigned_to" class="form-control">
                                <option value="">Select User to Assign</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('assigned_to') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Notes Field -->
                        <div class="col-md-12">
                            <label for="notes" class="form-label">Notes <span class="text-danger">*</span></label>
                            <textarea wire:model="notes" id="notes" class="form-control" rows="4" placeholder="Enter notes about the lead"></textarea>
                            @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove wire:target="createLead">Create Lead</span>
                                <span wire:loading wire:target="createLead">
                                    Please wait
                                    <div class="spinner-border spinner-border-sm text-light ms-2" role="status">
                                        <span class="visually-hidden"></span>
                                    </div>
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
