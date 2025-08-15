<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LeadResource extends JsonResource
{
    public function toArray($request): array
    {
        $user = Auth::user();

        $data = [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'status'    => $this->status,
            'notes'     => $this->notes,
            'created_at'=> $this->created_at->toDateTimeString(),
        ];

        // Only show assigned user details for admin users
        if ($user->role === 'admin') {
            $data['assigned_to'] = $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name
            ] : null;
        } else {
            // For agents, just show the assigned_to ID
            $data['assigned_to'] = $this->assigned_to;
        }

        return $data;
    }
}
