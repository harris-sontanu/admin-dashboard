<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Model::automaticallyEagerLoadRelationships();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('landing_page.news', function ($view) {
            $view->with('categories', Category::withCount('posts')->get());
        });
    }
}
