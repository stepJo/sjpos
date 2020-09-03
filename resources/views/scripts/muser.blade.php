<script>

    //MUSER - GLOBAL 
    let preloader = '{{ asset('public/adminlte/assets/images') }}/data-preloader.gif';

    //MUSER - ROLE
    function roleAccessFormData(context, menus, views, adds, edits, deletes) {
        $(context).find('.menu').each(function(index) {
            console.log(index);

            menus[index] = $(this).val();  

            views[index] = 0;
            adds[index] = 0; 
            edits[index] = 0;
            deletes[index] = 0;
        });

        $(context).find('.av').each(function(index) {
            let _this = $(this);

            if(_this.is(":checked") == true) {
                views[index] = 1;
            } else {
                views[index] = 0;
            }
        });

        $(context).find('.aa').each(function(index) {
            let _this = $(this);

            if(_this.is(":checked") == true) {
                adds[index] = 1;
            } else {
                adds[index] = 0;
            }
        });

        $(context).find('.ae').each(function(index) {
            let _this = $(this);

            if(_this.is(":checked") == true) {
                edits[index] = 1;
            } else {
                edits[index] = 0;
            }
        });

        $(context).find('.ad').each(function(index) {
            let _this = $(this);

            if(_this.is(":checked") == true) {
                deletes[index] = 1;
            } else {
                deletes[index] = 0;
            }
        });
    }

    let checked = false;
    
    $('.all-access').click(function() {
        if(!checked) {
            $('.av, .aa, .ae, .ad').each(function() {
                $(this).attr('checked', true);
            });

            checked = true;
        }
        else {
            $('.av, .aa, .ae, .ad').each(function() {
                $(this).attr('checked', false);
            });

            checked = false;
        }
    });

    $('#add-role-form').on('submit', function(e) {
        e.preventDefault();

        let menus = [];
        let views = [];
        let adds = [];
        let edits = [];
        let deletes = [];

        roleAccessFormData('#add-role-form', menus, views,adds, edits, deletes);

        $.ajax({
            type:'POST',
            url: '{{ route('role.store') }}',
            data: {
                _token: '{{ csrf_token() }}',
                role_name: $('#role_name').val(),
                menus: menus,
                views: views,
                adds: adds,
                edits: edits,
                deletes: deletes,
            },
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

        let menus = [];
        let views = [];
        let adds = [];
        let edits = [];
        let deletes = [];

        let id = $(this).data('id');

        roleAccessFormData(`#edit-role-form-${id}`, menus, views, adds, edits, deletes);

        let url = '{{ route('role.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            data: {
                _token: '{{ csrf_token() }}',
                role_name: $(this).find('input[name="role_name"]').val(),
                menus: menus,
                views: views,
                adds: adds,
                edits: edits,
                deletes: deletes,
            },
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.role_name, '.edit-role-name-error', '.edit-role-name-modal-error');
            }
        });
    });

    //MUSER - USER
    $('#add-user-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('user.store') }}',
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.u_name, '.add-u-name-error', '.add-u-name-modal-error');
                validateData(data.responseJSON.errors.u_email, '.add-u-email-error', '.add-u-email-modal-error');
                validateData(data.responseJSON.errors.u_contact, '.add-u-contact-error', '.add-u-contact-modal-error');
                validateData(data.responseJSON.errors.u_password, '.add-u-password-error', '.add-u-password-modal-error');  
                validateData(data.responseJSON.errors.confirm_password, '.add-confirm-password-error', '.add-confirm-password-modal-error');
                validateData(data.responseJSON.errors.b_id, '.add-b-id-error', '.add-b-id-modal-error');  
                validateData(data.responseJSON.errors.role_id, '.add-role-id-error', '.add-role-id-modal-error'); 
            }
        });
    });

    $('.edit-user-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('user.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.u_name, '.edit-u-name-error', '.edit-u-name-modal-error');
                validateData(data.responseJSON.errors.u_email, '.edit-u-email-error', '.edit-u-email-modal-error');
                validateData(data.responseJSON.errors.u_contact, '.edit-u-contact-error', '.edit-u-contact-modal-error');
                validateData(data.responseJSON.errors.b_id, '.edit-b-id-error', '.edit-b-id-modal-error');  
                validateData(data.responseJSON.errors.role_id, '.edit-role-id-error', '.edit-role-id-modal-error'); 
            }
        });
    });

    $('.edit-user-password-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('user-password.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.u_password, '.edit-u-password-error', '.edit-u-password-modal-error');  
                validateData(data.responseJSON.errors.confirm_password, '.edit-confirm-password-error', '.edit-confirm-password-modal-error');
            }
        });
    });

</script>