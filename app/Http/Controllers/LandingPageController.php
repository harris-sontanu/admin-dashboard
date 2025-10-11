<?php

namespace App\Http\Controllers;

use App\Services\LandingPageService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __construct(
        protected LandingPageService $landingPageService
    ){}
    public function home()
    {
        return view('landing_page.home');
    }

    public function news()
    {
        $data = $this->landingPageService->viewNews(null, 5);
        $news = $data['news'];
        $categories = $data['categories'];
        return view('landing_page.news',compact('news', 'categories'));
    }

    public function detailNews($slug)
    {
        $detailNews = $this->landingPageService->detailNews($slug);
        $data = $this->landingPageService->viewNews();
        $categories = $data['categories'];
        return view('landing_page.detail_news', compact('detailNews', 'categories'));
    }
}
