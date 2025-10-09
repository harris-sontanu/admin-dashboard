<script>
    $(function () {

        $(document).on('click', '#save-btn', function () {

            let form = $(this).parent().parent();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                dataType: 'json'
            }).fail(function (response) {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.entries(errors).forEach((entry) => {
                        const [key, value] = entry;
                        if (key === 'roles') {
                            form.find('#roles').append('<div class="invalid-feedback">' + value + '</div>');
                        }
                        form.find('#' + key).addClass('is-invalid');
                        form.find('#' + key).parent().append('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    location.reload();
                }
            });
        })

        const createModal = document.querySelector('#createModal');
        createModal.addEventListener('hide.bs.modal', function (event) {
            const createForm = document.getElementById('createForm');

            createForm.querySelectorAll('input').forEach((inputElement) => {
                inputElement.classList.remove('is-invalid');
            });

            $('#roles').parent().find('.invalid-feedback').remove();

            createForm.reset();
        })

        $('.deleteForm').submit(function (e) {
            e.preventDefault();

            let form = $(this);

            Swal.fire({
                title: 'You are sure?',
                text: "The selected user will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dab34d',
                cancelButtonColor: '#707070',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancelled'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.unbind('submit').submit();
                }
            });
        })

    });
</script>