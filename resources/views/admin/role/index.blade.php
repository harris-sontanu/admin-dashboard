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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">Add
                        Role</button>
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

@push('modals')
    @include('admin.role.create')
@endpush

@push('scripts')
    @include('admin.role.script')
@endpush