<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function list(){
        $permissions = Permission::latest()->paginate(10);

        // If no permissions exist, create some basic ones for testing
        if ($permissions->count() === 0) {
            $this->createBasicPermissions();
            $permissions = Permission::latest()->paginate(10);
        }

        return view('admin.permissions.index', compact('permissions'));
    }

    private function createBasicPermissions()
    {
        $basicPermissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions'
        ];

        foreach ($basicPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|max:255',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permissions.list')->with('success', 'Permission created successfully');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . '|max:255',
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('admin.permissions.list')->with('success', 'Permission updated successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.list')->with('success', 'Permission deleted successfully');
    }

    public function show(Permission $permission)
    {
        $roles = $permission->roles;
        return view('admin.permissions.show', compact('permission', 'roles'));
    }
}
