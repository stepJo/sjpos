<script>

    function validateData(data, error, modal) {
        if(data != null) {
            $(error).html(data[0]);

            $(modal).addClass('is-invalid');
        }
        else {
            $(error).html('');

            $(modal).removeClass('is-invalid');
        }
    }

    function successResponse(data) {
        toastr.success(`${data.message}`);

        $('.modal').modal('hide');

        setTimeout(function() {
            location.reload();
        }, 300);
    }

    //MBRANCH - BRANCH
    $('#add-branch-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('branch.store') }}',
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.b_code, '.add-b-code-error', '.add-b-code-modal-error');
                validateData(data.responseJSON.errors.b_name, '.add-b-name-error', '.add-b-name-modal-error');
                validateData(data.responseJSON.errors.b_email, '.add-b-email-error', '.add-b-email-modal-error');
                validateData(data.responseJSON.errors.b_contact, '.add-b-contact-error', '.add-b-contact-modal-error');  
                validateData(data.responseJSON.errors.b_status, '.add-b-status-error', '.add-b-status-modal-error');
            }
        });
    });

    $(document).on('click', '.edit-branch-form', function() {
        $('.edit-branch-form').on('submit', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            let url = '{{ route('branch.update', ':id') }}';

            $.ajax({
                type:'PATCH',
                url: url.replace(':id', id),
                data: $(this).serialize(),
                success: function(data) {
                    successResponse(data);
                },
                error: function(data) {
                    validateData(data.responseJSON.errors.b_code, '.edit-b-code-error', '.edit-b-code-modal-error');
                    validateData(data.responseJSON.errors.b_name, '.edit-b-name-error', '.edit-b-name-modal-error');
                    validateData(data.responseJSON.errors.b_email, '.edit-b-email-error', '.edit-b-email-modal-error');
                    validateData(data.responseJSON.errors.b_contact, '.edit-b-contact-error', '.edit-b-contact-modal-error');  
                    validateData(data.responseJSON.errors.b_status, '.edit-b-status-error', '.edit-b-status-modal-error');
                }
            });
        });
    });

</script>