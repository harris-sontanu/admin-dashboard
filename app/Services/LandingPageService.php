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

    public function viewNews($search = null, $perPage = null)
{
    $news = $this->postRepository->getAll($search, $perPage, true);
    $categories = $this->categoryRepository->getAll();

    return [
        'news' => $news,
        'categories' => $categories,
    ];
}

    public function detailNews($slug)
    {
        return $this->postRepository->getBySlug($slug);
    }
}
