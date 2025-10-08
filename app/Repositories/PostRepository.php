<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Type\Integer;

class PostRepository
{
    public function getAll(?string $search = null, ?int $limit = null): Collection
    {
        $query = Post::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $query = isset($limit)
            ? $query->limit($limit)
            : $query->limit(config()->get('app.pagination.per_page'));

        return $query->get();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    

    public function storePost($posts)
    {
        $post               = new Post();
        $post->category_id  = $posts['category'];
        $post->title        = $posts['title'];
        $post->slug         = $posts['slug'];
        $post->body         = $posts['body'];
        $post->excerpt      = $posts['excerpt'];
        $post->is_published = $posts['is_published'];

        if(isset($posts['image']) && !empty($posts['image'])){
            $post->image_url = uploadFile($posts['image'], 'posts');
        }

        return $post->save();
    }
}