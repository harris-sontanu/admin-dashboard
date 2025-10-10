<form id="editUserRoleForm" action="{{ route('admin.users.updateRole', $user->id) }}" method="post">
    @method('PUT')
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Edit Role {{ $user->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div>
            <label id="roles" for="roles" class="form-label">Roles</label>
            <div class="row">
                @foreach ($roles as $key => $value)
                    @if ($loop->first)
                        <div class="col">
                    @elseif ($loop->iteration === $loop->count / 2 + 1)
                            </div>
                            <div class="col">
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $key }}"
                                @checked($user->hasRole($key))>
                            <label class="form-check-label"> {{ $value }} </label>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button id="update-role-btn" type="button" class="btn btn-primary">Update</button>
    </div>
</form>