<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createForm" action="{{ route('admin.users.roles.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" id="name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label id="permissions" for="permissions" class="form-label">Permissions</label>
                        <div class="row">
                            @foreach ($permissions as $key => $value)
                                @if ($loop->first)
                                    <div class="col">
                                @elseif ($loop->iteration === $loop->count / 2 + 1)
                                        </div>
                                        <div class="col">
                                    @endif
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $key }}">
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
                    <button id="save-btn" type="button" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>