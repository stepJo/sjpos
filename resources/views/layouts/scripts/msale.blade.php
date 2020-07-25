<script>

    function validateData(data, error, modal) {
        let message = '';

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

        $('#addModal').modal('hide');

        setTimeout(function() {
            location.reload();
        }, 300);
    }

    //MSALE - DISCOUNT PRODUCT
    $('#add-discount-product-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{route('discount-product.store') }}',
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.p_id, '.add-p-id-error', '.add-p-id-modal-error');
                validateData(data.responseJSON.errors.dp_value, '.add-dp-value-error', '.add-dp-value-modal-error');
                validateData(data.responseJSON.errors.dp_status, '.add-dp-status-error', '.add-dp-status-modal-error');
            }
        });
    });

    $('.edit-discount-product-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('discount-product.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.p_id, '.edit-p-id-error', '.edit-p-id-modal-error');
                validateData(data.responseJSON.errors.dp_value, '.edit-dp-value-error', '.edit-dp-value-modal-error');
                validateData(data.responseJSON.errors.dp_status, '.edit-dp-status-error', '.edit-dp-status-modal-error');
            }
        });
    });

    $('#gen-code').on('click', function(e) {
        e.preventDefault();

        $.get('discount/generate', function(data) {
            $('#dis_code').val(data);
        });
    });

</script>