@extends('layouts.app')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Post /</span> Show</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="card-tile mb-0">Show Post</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        <div class="col-lg-4">
                            <label class="form-label">Category</label>
                            <select disabled class="form-select" name="category">
                                <option disabled selected="">Open this select menu</option>
                                @foreach ($categories as $category)
                                    <option {{ $post->category_id == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Title</label>
                            <input disabled type="text" id="title" class="form-control" placeholder="Title..." name="title"
                                value="{{ old('title', $post->title) }}">
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Slug</label>
                            <input disabled readonly id="slug" type="text" class="form-control" placeholder="slug..." name="slug"
                                value="{{ old('slug', $post->slug) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="col">
                            <label class="form-label">body</label>
                            <textarea disabled type="text" class="form-control" placeholder="body..."
                                name="body">{{ old('body', $post->body) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="col form-check form-switch mb-2">
                            <input type="hidden" name="is_published" value="0">
                            <input disabled {{ $post->is_published ? 'checked' : '' }} name="is_published" value="1"
                                class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                            <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-label">Image</label>
                            <a class="fancybox form-control" style="border: none;" href="{{ asset($post->image_url) }}"><img width="300px" class="mt-2"
                                    src="{{ asset($post->image_url) }}" alt=""></a>
                        </div>
                        <div class="col">
                            <label class="form-label">Excerpt</label>
                            <input disabled type="text" class="form-control" placeholder="Excerpt..." name="excerpt"
                                value="{{ old('excerpt', $post->excerpt) }}">

                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ Route('admin.category.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('js-content')
    <script>
        $('#title').on('input', function () {
            let nama = $(this).val();

            let slug = nama.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '');

            $('#slug').val(slug);
        });
    </script>
@endsection