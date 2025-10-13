@extends('layouts.app')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Role</h4>

        @include('layouts.alert')

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <div class="d-flex justify-content-between gap-4">
                    <form action="{{ route('admin.users.roles.index') }}" method="get">
                        <input type="search" class="form-control" name="search" placeholder="Search Role" @if (Request::get('search')) value="{{ Request::get('search') }}" @endif>
                    </form>
                    @can('create role')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">Add
                            Role</button>
                    @endcan
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="1">Name</th>
                            <th>Description</th>
                            <th>Permissions</th>
                            <th width="1" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($roles as $record)
                            <tr>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->description }}</td>
                                <td>{{ $record->permissions->implode('name', ', ') }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        @if ($record->name !== 'Super Admin')
                                            @can('edit role')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $record->id }}" class="btn p-0 btn-icon text-body">
                                                    <i class="icon-base bx bx-edit-alt icon-md"></i>
                                                </button>
                                            @endcan
                                            @can('delete role')
                                                <form class="deleteForm" action="{{ route('admin.users.roles.destroy', $record->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn p-0 btn-icon text-danger">
                                                        <i class="icon-base bx bx-trash icon-md"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if ($roles->hasPages())
                        <tfoot>
                            <tr>
                                <td colspan="100">
                                    {{ $roles->withQueryString()->links('pagination::bootstrap-5') }}
                                <td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>

@endsection

@push('modals')
    @include('admin.role.create')
    @include('admin.role.modal')
@endpush

@push('scripts')
    @include('admin.role.script')
@endpush