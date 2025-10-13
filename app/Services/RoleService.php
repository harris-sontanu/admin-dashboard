<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class RoleService
{
    public function __construct(
        protected RoleRepository $roleRepository,
        protected PermissionRepository $permissionRepository,
    ) {}

    public function listRoles(array $filters = [], ?int $perPage = null): LengthAwarePaginator
    {
        return $this->roleRepository->getAll($filters, $perPage);
    }

    public function create(array $data): Role
    {
        $role = $this->roleRepository->insert($data);

        foreach ($data['permissions'] as $id) {
            $this->permissionRepository->insertById($role, $id);
        }

        return $role;
    }

    public function edit(Role $role, array $data): Role
    {
        $this->roleRepository->update($role, $data);

        $this->permissionRepository->removeAll($role);
        foreach ($data['permissions'] as $id) {
            $this->permissionRepository->insertById($role, $id);
        }

        return $role;
    }

    public function remove(Role $role): void
    {
        $this->roleRepository->delete($role);
    }

    public function options(): SupportCollection
    {
        return $this->roleRepository->getAllOptions();
    }
}
