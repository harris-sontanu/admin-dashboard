<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    public function getAll(array $filters = [], ?int $limit = null): Collection
    {
        $query = Role::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        $query = isset($limit)
            ? $query->limit($limit)
            : $query->limit(config()->get('app.pagination.per_page'));

        return $query->get();
    }

    public function insert(array $data): ?Role
    {
        $role = new Role;

        $role->name = $data['name'];
        $role->description = $data['description'];

        return $role->save() ? $role : null;
    }
}
