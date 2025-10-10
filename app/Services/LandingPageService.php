<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;

class LandingPageService
{
    protected PostRepository $postRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function viewNews()
    {
        $this->categoryRepository->getAll();
        $this->postRepository->getAll();

        $data = [
            'news' => $this->postRepository->getAll(),
            'categories' => $this->categoryRepository->getAll(),
        ];
        return $data;
    }

    public function detailNews($slug)
    {
        return $this->postRepository->getBySlug($slug);
    }
}
