<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;

class DashboardRepository
{
    public function getAllUsers()
    {
        return User::count();
    }

    public function getAllPosts()
    {
        return Post::count();
    }
}