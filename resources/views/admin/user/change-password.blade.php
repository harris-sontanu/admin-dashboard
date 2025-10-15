<div class="modal fade" id="editPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="updatePasswordForm" action="{{ route('admin.users.updatePassword', Auth::user()->id) }}"
                method="post">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input name="current_password" type="password" id="current_password" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input name="password" id="new_password" type="password" class="form-control" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input name="password_confirmation" id="password_confirmation" type="password"
                            class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button id="update-password-btn" type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {

            $(document).on('click', '#update-password-btn', function () {

                let form = $(this).parent().parent(),
                    id = $(this).data('id');

                $.ajax({
                    url: form.attr('action'),
                    method: 'PUT',
                    data: form.serialize(),
                    dataType: 'json'
                }).fail(function (response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.entries(errors).forEach((entry) => {
                            let [key, value] = entry;
                            form.find('#' + key).addClass('is-invalid');
                            form.find('#' + key).parent().append('<div class="invalid-feedback">' + value + '</div>');
                        });
                    } else {
                        location.reload();
                    }
                });
            })
        });
    </script>
@endpush