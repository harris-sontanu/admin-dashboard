@extends('layouts.app')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Post /</span> List</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            {{-- <h5 class="card-header">Table Basic</h5> --}}
            <div class="d-flex justify-content-between p-4">
                <form action="">
                    <div class="input-group">
                        <input value="{{ $search }}" name="search" type="text" class="form-control"
                            id="basic-icon-default-fullname" placeholder="Search..." aria-label="John Doe"
                            aria-describedby="basic-icon-default-fullname2">
                        <button class="btn btn-primary">
                            <svg class="aa-SubmitIcon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                                <path
                                    d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Add Post</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.post.show', $post->id) }}"
                                            class="btn p-0 btn-link">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.post.edit', $post->id) }}"
                                            class="btn p-0 btn-link text-body me-1">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <button type="button" class="btn p-0 btn-link text-warning delete-data"
                                            data-route="{{ route('admin.post.destroy', $post->id) }}"
                                            data-token="{{ csrf_token() }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;">Posting Data is Empty!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>

@endsection