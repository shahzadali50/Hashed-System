<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $users, $name, $email, $phone, $status, $assigned_to, $notes;
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:new,contacted,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'required|string',
        ];
    }
    public function mount()
    {
        $this->users = User::where('role', 'agent')->pluck('name', 'id');

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
        flash()->success('Lead created successfully!');
        return redirect()->route('admin.leads.list');
    }
    public function render()
    {
        return view('livewire.lead.create');
    }
}
