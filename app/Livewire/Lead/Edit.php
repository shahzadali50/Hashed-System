<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $users, $name, $email, $phone, $status, $assigned_to, $notes, $lead_id;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $this->lead_id . ',id',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:new,contacted,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'required|string',
        ];
    }

    public function mount($id)
    {
        try {
            $lead = Lead::findOrFail($id);
            
            $this->lead_id = $lead->id;
            $this->name = $lead->name;
            $this->email = $lead->email;
            $this->phone = $lead->phone;
            $this->status = $lead->status;
            $this->assigned_to = $lead->assigned_to;
            $this->notes = $lead->notes;
            
            $this->users = User::where('role', 'agent')->pluck('name', 'id')->toArray();
            
        } catch (\Exception $e) {
            flash()->error('Error loading lead: ' . $e->getMessage());
            return redirect()->route('admin.leads.list');
        }
    }

    public function updateLead()
    {
        try {
            $this->validate();

            $lead = Lead::findOrFail($this->lead_id);
            $lead->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
                'assigned_to' => $this->assigned_to,
                'notes' => $this->notes,
            ]);

            flash()->success('Lead updated successfully!');
            return redirect()->route('admin.leads.list');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors are already handled by Livewire
            throw $e;
        } catch (\Exception $e) {
            flash()->error('Error updating lead: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.lead.edit');
    }
}
