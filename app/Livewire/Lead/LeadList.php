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
    public $leadId;

    public function mount()
    {
        $this->users = User::where('role', 'agent')->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.lead.lead-list', [
            'leads' => Lead::with('user:id,name')->latest()->paginate(8),
        ]);
    }
}