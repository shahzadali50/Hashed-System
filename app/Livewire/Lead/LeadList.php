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
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function mount()
    {
        $this->users = User::where('role', 'agent')->pluck('name', 'id')->toArray();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }

    public function getSortIcon($field)
    {
        if ($this->sortField !== $field) {
            return 'mdi mdi-sort';
        }
        
        return $this->sortDirection === 'asc' ? 'mdi mdi-sort-ascending' : 'mdi mdi-sort-descending';
    }

    public function render()
    {
        $leads = Lead::with('user:id,name')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.lead.lead-list', [
            'leads' => $leads,
        ]);
    }
}