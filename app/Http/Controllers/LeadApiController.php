<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\LeadService;
use App\Http\Requests\LeadRequest;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\LeadResource;
use Illuminate\Support\Facades\Auth;

class LeadApiController extends Controller
{
    use ApiResponseTrait;
    protected $leadService;

    public function __construct(LeadService $leadService)
    {
        $this->leadService = $leadService;
    }

    public function leads(Request $request)
    {
        try {
            $user = Auth::user();
            $leads = $this->leadService->getLeadsForUser($user);
            return $this->success(LeadResource::collection($leads), 'Leads fetched successfully');

        } catch (\Exception $e) {
            return $this->error('Failed to retrieve leads: ' . $e->getMessage(), 500);
        }
    }

    public function store(LeadRequest $request)
    {
        try {
            $user = Auth::user();

            if ($user->role !== 'admin') {
                return $this->error('Access denied. Only administrators can create leads.', 403);
            }

            $lead = $this->leadService->createLead($request->validated());

            return $this->success(new LeadResource($lead), 'Lead created successfully', 201);

        } catch (\Throwable $e) {
            // Log error for debugging
            \Log::error('Lead creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return $this->error('Something went wrong while creating the lead.', 500);
        }
    }



    public function show($id)
    {
        try {
            $user = Auth::user();
            $lead = $this->leadService->findLead($id);

            if (!$lead) {
                return $this->error('Lead not found', 404);
            }

            // Check access permissions
            if ($user->role === 'agent' && $lead->assigned_to !== $user->id) {
                return $this->error('Access denied. You can only view leads assigned to you.', 403);
            }

            return $this->success(new LeadResource($lead), 'Lead retrieved successfully');

        } catch (\Exception $e) {
            return $this->error('Failed to retrieve lead: ' . $e->getMessage(), 500);
        }
    }

    public function update(LeadRequest $request, $id)
    {
        try {
            $user = Auth::user();
            $lead = $this->leadService->findLead($id);

            if (!$lead) {
                return $this->error('Lead not found', 404);
            }

            // Check access permissions
            if ($user->role === 'agent' && $lead->assigned_to !== $user->id) {
                return $this->error('Access denied. You can only edit leads assigned to you.', 403);
            }

            // For agents, prevent changing assigned_to
            $data = $request->validated();
            if ($user->role === 'agent') {
                unset($data['assigned_to']);
            }

            $updatedLead = $this->leadService->updateLead($lead, $data);

            return $this->success(new LeadResource($updatedLead), 'Lead updated successfully');

        } catch (\Exception $e) {
            return $this->error('Failed to update lead: ' . $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = Auth::user();
            $lead = $this->leadService->findLead($id);

            if (!$lead) {
                return $this->error('Lead not found', 404);
            }

            // Only admin can delete leads
            if ($user->role !== 'admin') {
                return $this->error('Access denied. Only administrators can delete leads.', 403);
            }

            $this->leadService->deleteLead($lead);

            return $this->success(null, 'Lead deleted successfully');

        } catch (\Exception $e) {
            return $this->error('Failed to delete lead: ' . $e->getMessage(), 500);
        }
    }
}
