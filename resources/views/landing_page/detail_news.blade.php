@extends('landing_page.layouts.app')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Blog Details</h1>
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
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Blog Details</li>
                    </ol>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">

                                <div class="post-img">
                                    <img src="{{ asset($detailNews->image_url) }}" alt="" class="img-fluid">
                                </div>

                                <h2 class="title">{{ $detailNews->title }}</h2>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="blog-details.html">{{ $detailNews->excerpt }}</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="blog-details.html"><time
                                                    datetime="2020-01-01">{{ date('d F Y', strtotime($detailNews->created_at)) }}</time></a>
                                        </li>
                                    </ul>
                                </div><!-- End meta top -->

                                <div class="content">
                                    <p style="text-align: justify;">
                                        {!! $detailNews->body !!}
                                    </p>

                            </article>

                        </div>
                    </section><!-- /Blog Details Section -->

                    <!-- Blog Author Section -->

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