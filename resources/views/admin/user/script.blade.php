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

    });
</script>