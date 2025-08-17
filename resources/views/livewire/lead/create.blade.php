<div>
    <div class="card">
        <div class="card-header bg-dark d-flex justify-content-between align-items-center mb-5">
            <h3 class="card-title text-white h3">Create Lead</h3>
            <a href="{{ route('admin.leads.list') }}" class="btn btn-primary">
                Back to Leads
            </a>
        </div>
        <div class="card-body ">
            <form wire:submit="createLead">
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
                        <option disabled selected >Select User</option>
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
