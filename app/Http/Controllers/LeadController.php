<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function list()
    {
        return view('admin.leads.index');
    }

    public function create()
    {
        // Only admin can create leads
        if (Auth::user()->role !== 'admin') {
            flash()->error('Access denied. Only administrators can create leads.');
            return redirect()->route('admin.leads.list');
        }
        
        return view('admin.leads.create');
    }

    public function edit($id)
    {
        try {
            $lead = Lead::findOrFail($id);
            $user = Auth::user();
            
            // Check access permissions
            if ($user->role === 'agent' && $lead->assigned_to !== $user->id) {
                flash()->error('Access denied. You can only edit leads assigned to you.');
                return redirect()->route('admin.leads.list');
            }
            
            return view('admin.leads.edit', compact('lead'));
        } catch (\Exception $e) {
            flash()->error('Lead not found!');
            return redirect()->route('admin.leads.list');
        }
    }

    public function delete($id)
    {
        $user = Auth::user();
        $lead = Lead::find($id);
        
        if ($lead) {
            // Only admin can delete leads
            if ($user->role !== 'admin') {
                flash()->error('Access denied. Only administrators can delete leads.');
                return redirect()->back();
            }
            
            $lead->delete();
            flash()->success('Lead deleted successfully!');
            return redirect()->route('admin.leads.list');
        } else {
            flash()->error('Lead not found!');
            return redirect()->back();
        }
    }
}
