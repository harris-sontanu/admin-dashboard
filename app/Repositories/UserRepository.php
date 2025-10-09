<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getAll(array $filters = [], ?int $limit = null): Collection
    {
        $query = User::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%")
                ->orWhere('email', 'like', "%{$filters['search']}%");
        }

        $query = isset($limit)
            ? $query->limit($limit)
            : $query->limit(config()->get('app.pagination.per_page'));

        return $query->get();
    }

    public function insert(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
