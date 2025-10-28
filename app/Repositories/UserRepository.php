<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * Cache TTL in seconds
     */
    private const CACHE_TTL = 3600; // 1 hour

    /**
     * Get all users with optional filtering and pagination
     *
     * @param array $filters Search filters
     * @param int|null $perPage Number of items per page
     * @return LengthAwarePaginator
     */
    public function getAll(array $filters = [], ?int $perPage = null): LengthAwarePaginator
    {
        $query = User::query();

        if (isset($filters['search']) && !empty($filters['search'])) {
            $searchTerm = $filters['search'];
            $query->where(function(Builder $q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Apply additional filters if needed
        if (isset($filters['role_id'])) {
            $query->whereHas('roles', function(Builder $q) use ($filters) {
                $q->where('roles.id', $filters['role_id']);
            });
        }

        $perPage = $perPage ?? config('app.pagination.per_page', 10);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    /**
     * Find user by ID
     *
     * @param int $id User ID
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $id): User
    {
        return Cache::remember("user.{$id}", self::CACHE_TTL, function() use ($id) {
            return User::findOrFail($id);
        });
    }

    /**
     * Insert new user
     *
     * @param array $data User data
     * @return User
     */
    public function insert(array $data): User
    {
        $user = User::create($data);
        $this->clearUserCache($user->id);
        return $user;
    }

    /**
     * Update existing user
     *
     * @param User $user User model
     * @param array $data Updated data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);
        $this->clearUserCache($user->id);
        return $user;
    }

    /**
     * Delete user
     *
     * @param User $user User model
     * @return void
     */
    public function delete(User $user): void
    {
        $this->clearUserCache($user->id);
        $user->delete();
    }

    /**
     * Clear user cache
     *
     * @param int $userId User ID
     * @return void
     */
    private function clearUserCache(int $userId): void
    {
        Cache::forget("user.{$userId}");
    }
}
