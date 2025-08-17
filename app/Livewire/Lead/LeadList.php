<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
        // Sirf agents ka list assign karne ke liye
        $this->users = User::role('agent')->pluck('name', 'id')->toArray();
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

        return $this->sortDirection === 'asc'
            ? 'mdi mdi-sort-ascending'
            : 'mdi mdi-sort-descending';
    }

    public function render()
    {
        $user = Auth::user();
        $query = Lead::with('user:id,name');

        // 🚀 Role based filter
        if ($user->hasRole('agent')) {
            // Agent ko sirf apni leads dikhen
            $query->where('assigned_to', $user->id);
        } elseif ($user->hasRole('admin') || $user->hasRole('super_admin')) {
            // Admin aur Super Admin ko sb dikhen
            // ❌ no filter required
        }

        $leads = $query->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        return view('livewire.lead.lead-list', [
            'leads' => $leads,
            'userRole' => $user->getRoleNames()->first(), // show current role
        ]);
    }
}
