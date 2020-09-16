<script>

    //MCUSTOMER - GLOBAL
    let preloader = '{{ asset('public/adminlte/assets/images') }}/data-preloader.gif';

    $('#customerTable').DataTable({
        autoWidth: false,
        ordering: true,
        order: [[ 0, 'asc' ]],
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url: "{{ route('customer.index') }}",
        },
        language: 
        {
            info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ pelanggan</span>",
            infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
            infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ pelanggan)</span>",
            paginate: 
            {
                previous: "<i class='fas fa-chevron-left'></i>",
                next: "<i class='fas fa-chevron-right'></i>"
            },
            processing: `<img src="${preloader}">`,
            search: "<span class='font-weight-bold'>Cari pelanggan : </span>",
            searchPlaceholder: "...",
            zeroRecords: "<span class='font-weight-bold'>Pelanggan tidak ditemukan</span>",
        },
        oLanguage: 
        {
            sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ pelanggan</span>",
        },
        columns: 
        [
            {
                data: 'c_name',
                name: 'c_name'
            },
            {
                data: 'c_email',
                name: 'c_email'
            },
            {
                data: 'c_contact',
                name: 'c_contact'
            },
            {
                data: 'c_address',
                name: 'c_address'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });

    //MCUSTOMER - CUSTOMER
    $('#add-customer-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('customer.store') }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.c_name, '.add-c-name-error', '.add-c-name-modal-error');
                validateData(data.responseJSON.errors.c_email, '.add-c-email-error', '.add-c-email-modal-error');
            }
        });
    });

    $(document).on('click', '.edit-customer-form', function() {
        $('.edit-customer-form').on('submit', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            let url = '{{ route('customer.update', ':id') }}';

            $.ajax({
                type:'PATCH',
                url: url.replace(':id', id),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: $(this).serialize(),
                success: function(data) {
                    successResponse(data);
                },
                error: function(data) {
                    validateData(data.responseJSON.errors.c_name, '.edit-c-name-error', '.edit-c-name-modal-error');
                    validateData(data.responseJSON.errors.c_email, '.edit-c-email-error', '.edit-c-email-modal-error'); 
                }
            });
        });
    });

</script>