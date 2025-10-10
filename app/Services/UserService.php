<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected RoleRepository $roleRepository,
    ) {}

    public function listUsers(array $filters = []): Collection
    {
        return $this->userRepository->getAll($filters);
    }

    public function create(array $data): User
    {
        $user = $this->userRepository->insert($data);

        foreach ($data['roles'] as $id) {
            $this->roleRepository->insertById($user, $id);
        }

        return $user;
    }

    public function edit(User $user, array $data): User
    {
        if (isset($data['avatar'])) {
            $data['avatar'] = $data['avatar']->store('avatars');
        } else {
            (isset($data['is_avatar_removed']) && $data['is_avatar_removed'])
                ? $data['avatar'] = null
                : $data['avatar'] = $user->avatar;
        }

        return $this->userRepository->update($user, $data);
    }

    public function remove(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function editRole(User $user, array $data): User
    {
        $this->roleRepository->removeAll($user);
        foreach ($data['roles'] as $id) {
            $this->roleRepository->insertById($user, $id);
        }

        return $user->refresh();
    }
}
