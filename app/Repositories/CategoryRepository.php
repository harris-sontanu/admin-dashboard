<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Type\Integer;

class CategoryRepository
{
    public function getAll(?string $search = null, ?int $perPage = null)
    {
        $query = Category::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $perPage = $perPage ?? config('app.pagination.per_page', 10);

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById(?int $id)
    {
        $query = Category::find($id);
        return $query;
    }

    public function storeCategory (?array $categories)
    {
        $category              = new Category;
        $category->name        = $categories['name'];
        $category->slug        = $categories['slug'];
        $category->description = $categories['description'];
        return $category->save();
    }

    public function updateCategory (?array $categories, $category)
    {
        $category->name        = $categories['name'];
        $category->slug        = $categories['slug'];
        $category->description = $categories['description'];
        return $category->save();
        
    }

    public function destroyCategory($category)
    {
        return Category::destroy($category);
    }
}