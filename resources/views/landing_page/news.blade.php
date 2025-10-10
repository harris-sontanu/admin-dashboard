@extends('landing_page.layouts.app')

@section('content')
    <main class="main">

        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>News</h1>
                            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                                voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi
                                ratione sint. Sit quaerat ipsum dolorem.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">News</li>
                    </ol>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <section id="blog-posts" class="blog-posts section">
                        <div class="container">
                            <div class="row gy-4">
                                @foreach ($news as $new)
                                    @if ($new->is_published == 1)
                                        <div class="col-12">
                                            <article>
                                                <div class="post-img">
                                                    <img src="{{ asset($new->image_url) }}" alt="" class="img-fluid">
                                                </div>
                                                <h2 class="title">
                                                    <a href="{{ route('news.detail', $new->slug) }}">{{ $new->title }}</a>
                                                </h2>
                                                <div class="meta-top">
                                                    <ul>
                                                        @if ($new->excerpt)
                                                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                                    href="#">{{ $new->excerpt }}</a></li>
                                                        @endif
                                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                                href="#"><time datetime="2022-01-01">{{ date('d F Y', strtotime($new->created_at)) }}</time></a></li>
                                                    </ul>
                                                </div>
                                                <div class="content">
                                                    <p style="text-align:justify;">
                                                        @if (strlen($new->body) > 200)
                                                            {{ substr($new->body, 0, 200) }}...
                                                        @else
                                                            {{ $new->body }}
                                                        @endif
                                                    </p>

                                                    <div class="read-more">
                                                        <a href="{{ route('news.detail', $new->slug) }}">Read More</a>
                                                    </div>
                                                </div>

                                            </article>
                                        </div>
                                    @endif
                                @endforeach

                            </div><!-- End blog posts list -->

                        </div>

                    </section>
                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Categories Widget -->
                        <div class="categories-widget widget-item">

                            <h3 class="widget-title">Categories</h3>
                            <ul class="mt-3">
                                @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->name }}<span>({{ count($category->posts) }})</span></a></li>
                                @endforeach
                            </ul>

                        </div><!--/Categories Widget -->

                        <!-- Recent Posts Widget -->

                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection