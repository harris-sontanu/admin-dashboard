<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function getAll(): Collection
    {
        return Permission::all()->pluck('name', 'id');
    }

    public function insertById(Role $role, int $id): void
    {
        $role->givePermissionTo(Permission::find($id));
    }
}
