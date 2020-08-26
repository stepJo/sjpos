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

    //MUSER - ROLE
    $('#add-role-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('role.store') }}',
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.role_name, '.add-role-name-error', '.add-role-name-modal-error');
            }
        });
    });

    $('.edit-role-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('role.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.role_name, '.edit-role-name-error', '.edit-role-name-modal-error');
            }
        });
    });

</script>