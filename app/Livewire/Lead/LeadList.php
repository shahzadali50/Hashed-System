<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LeadList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $users, $name, $email, $phone, $status, $assigned_to, $notes;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:leads,email',
        'phone' => 'required|string|max:20',
        'status' => 'required|in:new,contacted,closed',
        'assigned_to' => 'nullable|exists:users,id',
        'notes' => 'required|string',
    ];

        public function mount()
        {
            $this->users = User::where('role', 'agent')->pluck('name', 'id');
        }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'phone', 'status', 'assigned_to', 'notes']);
        $this->resetValidation();
        $this->dispatch('reset-form'); // Dispatch event to reset form in JavaScript
    }

    public function createLead()
    {
        $this->validate();

        Lead::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'assigned_to' => $this->assigned_to,
            'notes' => $this->notes,
        ]);

        $this->resetForm();
        $this->dispatch('close-modal', 'createLeadModal');
        flash()->success('Lead created successfully!'); // Fixed message
    }

    public function deleteLead($leadId)
    {
        Lead::findOrFail($leadId)->delete();
        flash()->success('Lead deleted successfully!');
    }

    public function render()
    {
        return view('livewire.lead.lead-list', [
            'leads' => Lead::with('user:id,name')->latest()->paginate(8),
        ]);
    }
}
