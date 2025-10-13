<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAll(array $filters = [], ?int $perPage = null): LengthAwarePaginator
    {
        $query = User::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%")
                ->orWhere('email', 'like', "%{$filters['search']}%");
        }

        $perPage = $perPage ?? config('app.pagination.per_page', 10);

        return $query->paginate($perPage)->withQueryString();
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
