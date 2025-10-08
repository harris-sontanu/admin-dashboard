<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __construct(
        protected RoleRepository $roleRepository,
        protected PermissionRepository $permissionRepository,
    ) {}

    public function listRoles(array $filters = []): Collection
    {
        return $this->roleRepository->getAll($filters);
    }

    public function create(array $data): Role
    {
        $role = $this->roleRepository->insert($data);

        foreach ($data['permissions'] as $id) {
            $this->permissionRepository->insertById($role, $id);
        }

        return $role;
    }
}
