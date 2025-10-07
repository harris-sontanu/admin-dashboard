<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getAll(?int $limit = null): Collection
    {
        $query = User::query();

        $query = isset($limit)
            ? $query->limit($limit)
            : $query->limit(config()->get('app.pagination.per_page'));

        return $query->get();
    }
}
