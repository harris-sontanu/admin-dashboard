<form id="editForm" action="{{ route('admin.users.roles.update', $role->id) }}" method="post">
    @method('PUT')
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" id="name" class="form-control" value="{{ $role->name }}" />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"
                rows="3">{{ $role->description }}</textarea>
        </div>
        <div class="mb-3">
            <label id="permissions" for="permissions" class="form-label">Permissions</label>
            @foreach ($permissions as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $key }}"
                        @checked($role->hasPermissionTo($key))>
                    <label class="form-check-label"> {{ $value }} </label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button id="update-btn" type="button" class="btn btn-primary">Update</button>
    </div>
</form>