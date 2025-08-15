<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function list()
    {
        return view('admin.leads.index');
    }
    public function create()
    {
        return view('admin.leads.create');
    }
    public function edit($id)
    {
        try {
            $lead = Lead::findOrFail($id);
            return view('admin.leads.edit', compact('lead'));
        } catch (\Exception $e) {
            flash()->error('Lead not found!');
            return redirect()->route('admin.leads.list');
        }
    }
    public function delete($id)
    {
        $lead = Lead::find($id);
        if ($lead) {
            $lead->delete();
            flash()->success('Lead deleted successfully!');
            return redirect()->back();
        } else {
            flash()->error('Lead not found!');
            return redirect()->back();
        }
    }
    
}
