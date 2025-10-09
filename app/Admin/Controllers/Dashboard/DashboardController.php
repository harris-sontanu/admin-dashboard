<?php

namespace App\Admin\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ){}
    public function index()
    {
        $userCount = $this->dashboardService->getAllUsers();
        $newsCount = $this->dashboardService->getAllPosts();
        return view('admin.dashboard.index', compact(
            'userCount',
            'newsCount'
        ));
    }
}
