@extends('layouts.app')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> List</h4>

        @include('layouts.alert')

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <div class="d-flex justify-content-between gap-4">
                    <form action="{{ route('admin.users.index') }}" method="get">
                        <input type="search" class="form-control" name="search" placeholder="Search User" @if (Request::get('search')) value="{{ Request::get('search') }}" @endif>
                    </form>
                    @can('create user')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">Add
                            User</button>
                    @endcan
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="1">Name</th>
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
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editUserRoleModal"
                                            data-id="{{ $user->id }}" class="btn p-0 btn-icon text-body">
                                            <i class="icon-base bx bx-edit-alt icon-md"></i>
                                        </button>
                                        @can('delete user')
                                            <form class="deleteForm" action="{{ route('admin.users.destroy', $user->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn p-0 btn-icon text-danger">
                                                    <i class="icon-base bx bx-trash icon-md"></i>
                                                </button>
                                            </form>
                                        @endcan
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

@push('modals')
    @include('admin.user.create')
    @include('admin.user.modal')
@endpush

@push('scripts')
    @include('admin.user.script')
@endpush