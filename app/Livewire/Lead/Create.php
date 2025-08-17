<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
        try {
            $user = Auth::user();
            $this->users = User::where('role', 'agent')->pluck('name', 'id')->toArray();
        } catch (\Exception $e) {
            $this->users = [];
            flash()->error('Error loading users: ' . $e->getMessage());
        }
    }

    public function createLead()
    {
        try {
            $this->validate();
            Lead::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
                'assigned_to' => $this->assigned_to,
                'notes' => $this->notes,
            ]);
            $this->resetValidation();
            flash()->success('Lead created successfully!');
            return redirect()->route('admin.leads.list');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            flash()->error('Error creating lead: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        try {
            $this->reset(['name', 'email', 'phone', 'status', 'assigned_to', 'notes']);
            $this->resetValidation();
        } catch (\Exception $e) {
            flash()->error('Error resetting form: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            return view('livewire.lead.create');
        } catch (\Exception $e) {
            flash()->error('Error rendering component: ' . $e->getMessage());
            return view('livewire.lead.create')->with('error', 'Component error occurred');
        }
    }
}
