@extends('layouts.app')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> List</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <div class="d-flex justify-content-between gap-4">
                    <form action="" method="get">
                        <input type="search" class="form-control" id="dt-search-0" placeholder="Search User">
                    </form>
                    <a href="#" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="1">Nama</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Last Logged In</th>
                            <th>Registered</th>
                            <th width="1" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4"><img src="{{ $user->avatarUrl }}"
                                                    alt="{{ $user->name }}" class="rounded-circle"></div>
                                        </div>
                                        <div class="d-flex flex-column"><a href="#" class="text-body text-truncate"><span
                                                    class="fw-medium">{{ $user->name }}</span></a></div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td><span data-bs-toggle="tooltip"
                                        title="{{ $user->last_logged_in_at?->format('j F Y, H:i') }}">{{ $user->last_logged_in_at?->format('j M Y') }}</span>
                                </td>
                                <td><span data-bs-toggle="tooltip"
                                        title="{{ $user->created_at?->format('j F Y, H:i') }}">{{ $user->created_at->format('j M Y') }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn p-0 btn-icon text-body">
                                            <i class="icon-base bx bx-edit-alt icon-md"></i>
                                        </button>
                                        <button type="button" class="btn p-0 btn-icon text-warning">
                                            <i class="icon-base bx bx-trash icon-md"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>

@endsection