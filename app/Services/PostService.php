<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository,
    ) {}
    
    public function listPost($search): Collection
    {
        return $this->postRepository->getAll($search);
    }

    public function formCreate()
    {
        return $this->postRepository->getAllCategories();
    }

    public function storePost($posts)
    {
        return $this->postRepository->storePost($posts);
    }
}