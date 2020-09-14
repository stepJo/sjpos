<script>

    //MAPP - PROFILE
    $('.edit-profile-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('profile.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.app_name, '.edit-app-name-error', '.edit-app-name-modal-error');
                validateData(data.responseJSON.errors.app_email, '.edit-app-email-error', '.edit-app-email-modal-error');
            }
        });
    });

    $('.edit-logo-form').on('submit', function(e) {
        e.preventDefault();

        let data = new FormData(this);

        let file = $('#upload_file')[0].files[0];    
        
        data.append('app_logo', file);
        data.append('_method', 'PATCH');

        let id = $(this).data('id');

        let url = '{{ route('profile-logo.update', ':id') }}';

        $.ajax({
            type:'POST',
            url: url.replace(':id', id),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: data,
            contentType: false, 
            cache: false, 
            processData: false,
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.image, '.edit-image-error', '.edit-image-modal-error');
            }
        });
    });

</script>