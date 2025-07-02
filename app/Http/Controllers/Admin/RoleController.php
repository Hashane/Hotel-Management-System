<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::all(),
        ]);
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return back()->with('success', 'Permissions updated for role: '.$role->name);
    }
}
