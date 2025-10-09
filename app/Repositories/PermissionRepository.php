<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function findById(int $id): ?Permission
    {
        return Permission::find($id);
    }

    public function getAll(): Collection
    {
        return Permission::all()->pluck('name', 'id');
    }

    public function insertById(Role $role, int $id): void
    {
        $permission = $this->findById($id);
        $role->givePermissionTo($permission);
    }

    public function removeAll(Role $role): void
    {
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }
    }
}
