<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class RoleRepository
{
    public function findById(int $id): ?Role
    {
        return Role::find($id);
    }

    public function getAll(array $filters = [], ?int $perPage = null): LengthAwarePaginator
    {
        $query = Role::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        $perPage = $perPage ?? config('app.pagination.per_page', 10);

        return $query->paginate($perPage)->withQueryString();
    }

    public function insert(array $data): ?Role
    {
        $role = new Role;

        $role->name = $data['name'];
        $role->description = $data['description'];

        return $role->save() ? $role : null;
    }

    public function update(Role $role, array $data): ?Role
    {
        $role->name = $data['name'];
        $role->description = $data['description'];

        return $role->save() ? $role : null;
    }

    public function delete(Role $role): void
    {
        $role->delete();
    }

    public function getAllOptions(): SupportCollection
    {
        return Role::all()->pluck('name', 'id');
    }

    public function insertById(User $user, int $id): void
    {
        $role = $this->findById($id);
        $user->assignRole($role);
    }

    public function removeAll(User $user): void
    {
        foreach ($user->roles as $role) {
            $user->removeRole($role);
        }
    }
}
