<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {}

    public function listUsers(): Collection
    {
        return $this->userRepository->getAll();
    }
}
