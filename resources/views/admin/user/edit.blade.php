<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.users.update', Auth::user()->id) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" id="name" class="form-control"
                            value="{{ Auth::user()->name }}" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" id="email" class="form-control"
                            value="{{ Auth::user()->email }}" />
                    </div>
                    <div>
                        <label for="avatar" class="form-label">Avatar</label>
                        <img id="userAvatar" src="{{ Auth::user()->avatarUrl }}" alt="{{ Auth::user()->name }}"
                            class="d-block rounded img-fluid mb-3" height="100">
                        @isset (Auth::user()->avatar)
                            <button type="button" class="btn btn-sm btn-danger mt-2" id="removeAvatarBtn"
                                data-user="{{ Auth::user()->id }}">Remove
                                Avatar</button>
                        @else
                            <input name="avatar" type="file" id="avatar" class="avatar-input form-control" />
                        @endisset
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {

            $(document).on('change', '.avatar-input', function (event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#userAvatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#removeAvatarBtn').click(function () {
                $('#userAvatar').attr('src', 'https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=170&background=random&font-size=0.35');

                $(this).parent().append('<input name="avatar" type="file" id="avatar" class="avatar-input form-control" />');
                $(this).parent().append('<input type="hidden" name="is_avatar_removed" value="1" />');
                $(this).remove();
            });

        });
    </script>
@endpush