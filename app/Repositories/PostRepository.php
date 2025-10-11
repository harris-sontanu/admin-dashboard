<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Type\Integer;

class PostRepository
{
    public function getAll(?string $search = null, ?int $perPage = null, bool $onlyPublished = false)
    {
        $query = Post::query();

        if ($onlyPublished) {
            $query->where('is_published', 1);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $perPage = $perPage ?? config('app.pagination.per_page', 10);

        return $query->with('category')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getById(?int $id)
    {
        return Post::find($id);
    }

    public function storePost(?array $posts)
    {
        $post               = new Post();
        $post->category_id  = $posts['category'];
        $post->title        = $posts['title'];
        $post->slug         = $posts['slug'];
        $post->body         = $posts['body'];
        $post->excerpt      = $posts['excerpt'];
        $post->is_published = filter_var($posts['is_published'], FILTER_VALIDATE_BOOLEAN);

        if(isset($posts['image']) && !empty($posts['image'])){
            $post->image_url = uploadFile($posts['image'], 'posts');
        }

        return $post->save();
    }

    public function updatePost(?array $posts, $post)
    {
        $post->category_id  = $posts['category'];
        $post->title        = $posts['title'];
        $post->slug         = $posts['slug'];
        $post->body         = $posts['body'];
        $post->excerpt      = $posts['excerpt'];
        $post->is_published = filter_var($posts['is_published'], FILTER_VALIDATE_BOOLEAN);

        if(isset($posts['image']) && !empty($posts['image'])){
            $post->image_url = uploadFile($posts['image'], 'posts');
        }

        return $post->save();
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image_url && file_exists(public_path($post->image_url))) {
            unlink(public_path($post->image_url));
        }

        return $post->delete();
    }

    public function getBySlug($slug)
    {
        return Post::where('slug', $slug)->first();
    }
}