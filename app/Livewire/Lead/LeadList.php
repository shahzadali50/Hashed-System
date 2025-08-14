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
    public $users;
    public $name, $email, $phone, $status, $assigned_to, $notes;
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:leads,email',
        'phone' => 'required|string|max:20',
        'status' => 'required|in:new,contacted,closed',
        'assigned_to' => 'nullable|exists:users,id',
        'notes' => 'required|string',
    ];

    public function openCreateModal()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->status = '';
        $this->assigned_to = '';
        $this->notes = '';
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

        $this->reset(['name', 'email', 'phone', 'status', 'assigned_to', 'notes']);

        $this->dispatch('close-modal');
        flash()->success('Lead created successfully!');
    }

    public function deleteLead($leadId)
    {
        $lead = Lead::findOrFail($leadId);
        $lead->delete();

        // $this->loadData();
        flash()->success('Lead deleted successfully!');
    }

    public function render()
    {
        $this->users = User::select('id', 'name')->get();

        return view('livewire.lead.lead-list', [
            'leads' => Lead::with('user:id,name')->latest()->paginate(4)
        ]);
    }

}
