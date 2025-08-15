<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;

class LeadService
{
    public function getAllLeads($userRole = null, $userId = null)
    {
        $query = Lead::with('user:id,name')->latest();

        // Apply role-based filtering
        if ($userRole === 'agent' && $userId) {
            $query->where('assigned_to', $userId);
        }
        // Admin can see all leads (no additional filter needed)

        return $query->get();
    }

    public function getLeadsForUser($user)
    {
        return $this->getAllLeads($user->role, $user->id);
    }

    public function createLead(array $data): Lead
    {
        return Lead::create($data);
    }

    public function updateLead(Lead $lead, array $data): Lead
    {
        $lead->update($data);
        return $lead->fresh();
    }

    public function deleteLead(Lead $lead): bool
    {
        return $lead->delete();
    }

    public function findLead($id): ?Lead
    {
        return Lead::with('user:id,name')->find($id);
    }

    public function createContact(array $data): ContactUs
    {
        return ContactUs::create($data);
    }
}
