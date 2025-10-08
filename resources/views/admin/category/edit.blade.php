@extends('layouts.app')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> Edit</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="card-tile mb-0">Edit Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mb-2">
                        <div class="col">
                            <label class="form-label" for="ecommerce-product-name">Name</label>
                            <input id="name" type="text" class="form-control" placeholder="Name..." name="name" value="{{ old('name', $category->name) }}">
                        </div>
                        <div class="col">
                            <label class="form-label" for="ecommerce-product-sku">slug</label>
                            <input readonly id="slug" type="text" class="form-control" placeholder="Slug..." name="slug" value="{{ old('slug', $category->slug) }}">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="ecommerce-product-name">Description</label>
                        <textarea type="text" class="form-control" placeholder="Description..."
                            name="description" aria-label="Product title">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ Route('admin.category.index') }}" class="btn btn-danger">Back</a>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('js-content')
    <script>
        $('#name').on('input', function () {
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