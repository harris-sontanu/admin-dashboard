<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function __construct(
        protected DashboardRepository $dashboardRepository,
    ) {}
    
    public function getAllUsers()
    {
        return $this->dashboardRepository->getAllUsers();
    }

    public function getAllPosts()
    {
        return $this->dashboardRepository->getAllPosts();
    }
    
}
