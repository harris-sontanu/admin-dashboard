<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use Illuminate\Support\Collection;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository
    ) {}

    public function options(): Collection
    {
        return $this->permissionRepository->getAll();
    }
}
