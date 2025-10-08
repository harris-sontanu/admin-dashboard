<?php

namespace App\Admin\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService $roleService,
        protected PermissionService $permissionService,
    ) {}

    public function index(Request $request)
    {
        $filters = [];
        if ($request->get('search')) {
            $filters['search'] = $request->input('search');
        }

        $roles = $this->roleService->listRoles($filters);
        $permissions = $this->permissionService->options();

        return view('admin.role.index', compact(
            'roles',
            'permissions',
        ));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->roleService->create($validated);

        return redirect()
            ->route('admin.users.roles.index')
            ->with('alert-success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionService->options();

        return view('admin.role.edit', compact(
            'role',
            'permissions',
        ));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();
        $this->roleService->edit($role, $validated);

        return redirect()
            ->route('admin.users.roles.index')
            ->with('alert-success', 'Role updated successfully');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->roleService->remove($role);

        return redirect()
            ->route('admin.users.roles.index')
            ->with('alert-success', 'Role deleted successfully');
    }
}
