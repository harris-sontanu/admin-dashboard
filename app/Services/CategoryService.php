<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {}

    public function listCategories($search): Collection
    {
        return $this->categoryRepository->getAll($search);
    }

    public function storeCategory($categories)
    {
        return $this->categoryRepository->storeCategory($categories);
    }

    public function formEdit($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function updateCategory($categories, $id)
    {
        $category = $this->categoryRepository->getById($id);
        return $this->categoryRepository->updateCategory($categories, $category);
    }

    public function destroyCategory($id)
    {
        return $this->categoryRepository->destroyCategory($id);
    }
}
