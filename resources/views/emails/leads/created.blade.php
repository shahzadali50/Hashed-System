@component('mail::message')
# 🎉 New Lead Created

A new lead has been added to the system.

**Lead Details:**

- **Name:** {{ $lead->name }}
- **Email:** {{ $lead->email }}
- **Phone:** {{ $lead->phone }}
- **Status:** {{ ucfirst($lead->status) }}
- **Notes:** {{ $lead->notes }}

@if($lead->assigned_to)
- **Assigned To:** {{ $lead->user->name ?? 'N/A' }}
@endif

@component('mail::button', ['url' => route('admin.leads.list')])
View Leads
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
