<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function list(){
        $roles = Role::latest()->paginate(10);

        // If no roles exist, create some basic ones for testing
        if ($roles->count() === 0) {
            $this->createBasicRoles();
            $roles = Role::latest()->paginate(10);
        }

        return view('admin.roles.index', compact('roles'));
    }

    private function createBasicRoles()
    {
        $basicRoles = [
            'admin',
            'manager',
            'user'
        ];

        foreach ($basicRoles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('admin.roles.list')->with('success', 'Role created successfully');
    }
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('admin.roles.list')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.list')->with('success', 'Role deleted successfully');
    }

    public function assignPermissions(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.assign-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        try {
            // Get permission IDs from request
            $permissionIds = $request->permissions ?? [];

            if (!empty($permissionIds)) {
                // Get the actual permission models first
                $permissions = Permission::whereIn('id', $permissionIds)->get();

                if ($permissions->count() !== count($permissionIds)) {
                    return redirect()->back()->with('error', 'Some permissions were not found. Please try again.');
                }

                // Use permission names instead of models
                $permissionNames = $permissions->pluck('name')->toArray();
                $role->syncPermissions($permissionNames);
            } else {
                // If no permissions selected, remove all permissions
                $role->syncPermissions([]);
            }

            return redirect()->route('admin.roles.list')->with('success', 'Role permissions updated successfully');

        } catch (\Exception $e) {
            Log::error('Error updating permissions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating permissions: ' . $e->getMessage());
        }
    }
}
