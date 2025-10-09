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

    public function getAllCategories()
    {
        return $this->postRepository->getAllCategories();
    }

    public function storePost($posts)
    {
        return $this->postRepository->storePost($posts);
    }

    public function formEdit($id)
    {
        return $this->postRepository->getById($id);
    }

    public function updatePost($posts, $id)
    {
        $post = $this->postRepository->getById($id);
        return $this->postRepository->updatePost($posts, $post);
    }

    public function destroyPost($id)
    {
        return $this->postRepository->destroyPost($id);
    }
}