<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view users')->only(['list', 'show']);
        $this->middleware('permission:create users')->only(['create', 'store']);
        $this->middleware('permission:edit users')->only(['edit', 'update']);
        $this->middleware('permission:delete users')->only(['destroy']);
    }
    public function list()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = Auth::user();

        // If user is super_admin, show all roles including super_admin
        if ($user->hasRole('super_admin')) {
            $roles = Role::all();
        } else {
            // For non-super-admin users, exclude super_admin role
            $roles = Role::where('name', '!=', 'super_admin')->get();
        }

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Validate roles based on user permissions
        $allowedRoles = $user->hasRole('super_admin')
            ? Role::pluck('id')->toArray()
            : Role::where('name', '!=', 'super_admin')->pluck('id')->toArray();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id|in:' . implode(',', $allowedRoles)
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Assign roles if selected
            if ($request->has('roles') && !empty($request->roles)) {
                $roles = Role::whereIn('id', $request->roles)->get();
                $user->assignRole($roles);
            }

            return redirect()->route('admin.users.list')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(User $user)
    {
        $currentUser = Auth::user();

        // If current user is super_admin, show all roles including super_admin
        if ($currentUser->hasRole('super_admin')) {
            $roles = Role::all();
        } else {
            // For non-super-admin users, exclude super_admin role
            $roles = Role::where('name', '!=', 'super_admin')->get();
        }

        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $currentUser = Auth::user();

        // Validate roles based on user permissions
        $allowedRoles = $currentUser->hasRole('super_admin')
            ? Role::pluck('id')->toArray()
            : Role::where('name', '!=', 'super_admin')->pluck('id')->toArray();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id|in:' . implode(',', $allowedRoles)
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            // Sync roles
            if ($request->has('roles')) {
                $roles = Role::whereIn('id', $request->roles)->get();
                $user->syncRoles($roles);
            } else {
                $user->syncRoles([]);
            }

            return redirect()->route('admin.users.list')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            // Don't allow admin to delete themselves
            if (Auth::id() === $user->id) {
                return redirect()->back()->with('error', 'You cannot delete your own account');
            }

            $user->delete();
            return redirect()->route('admin.users.list')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }
}
