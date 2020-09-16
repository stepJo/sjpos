<script>

    //MSALE - GLOBAL
    let preloader = '{{ asset('public/adminlte/assets/images') }}/data-preloader.gif';

    //MSALE - DISCOUNT PRODUCT
    @if(Request::segment(1) != 'pos')
    
        let path = '{{ route('discount-product.search') }}';

        function returnProduct(item) {
            if(item.p_status == 1) {
                return `${item.p_name} - ${item.p_code}`;
            }
            else {
                return `${item.p_name} - ${item.p_code} ( Tidak Aktif )`;
            }
        }

        $('.searchInput').typeahead({ 
            hint: true,
            items: 10,
            source: function(query, process) {
                return $.get(path, function(data) {
                    return process(data);
                });
            },
            matcher: function(item) {
                for (let attr in item) {
                    if (item[attr].toString().toLowerCase().indexOf(this.query.toLowerCase())) return true;
                }
                return false;
            },
            displayText: function(item) {
                return returnProduct(item);
            },
            afterSelect: function(data) {

                $('input[name="p_id"], #p_id').val(data.p_id);

                $('#discountProductInput').val('');
            }
        });

    @endif

    $('#add-discount-product-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{route('discount-product.store') }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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

    //MSALE - TRANSACTION
    function renderTransactionTable(start_date = '', end_date = '') {
        $('#transactionTable').DataTable({
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: true,
            order: [[ 5, 'desc' ]],
            ajax: 
            {
                url: "{{ route('transaction.index') }}",
                data:{ start_date:start_date, end_date:end_date }
            },
            fnDrawCallback: function() {
                let api = this.api();
                
                let json = api.ajax.json();

                $(api.column().footer()).html(`<h5 class="font-weight-bold my-2">Total Transaksi : <span class="ml-2 text-danger">${moneyFormat(json.sum_t_total)}</span></h5>`);
            },
            language: 
            {
                info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ transaksi</span>",
                infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ transaksi)</span>",
                paginate: 
                {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                },
                processing: `<img src="${preloader}">`,
                search: "<span class='font-weight-bold'>Cari transaksi : </span>",
                searchPlaceholder: "...",
                zeroRecords: "<span class='font-weight-bold'>Transaksi tidak ditemukan</span>",
            },
            oLanguage: 
            {
                sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ transaksi</span>",
            },
            createdRow: function (row, data, dataIndex) {
                $(row).attr('data-id', data.t_id);
                $(row).find('td:last-child').addClass('actions');
            },
            columns: 
            [
                {
                    data: 't_code',
                    name: 't_code'
                },
                {
                    data: 't_type',
                    name: 't_type'
                },
                {
                    data: 't_total',
                    name: 't_total'
                },
                {
                    data: 't_tax',
                    name: 't_tax'
                },
                {
                    data: 't_disc',
                    name: 't_disc'
                },
                {
                    data: 't_date',
                    name: 't_date'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]
        });
    }

    $('#btn-search-trans').on('click', function(e) {
        e.preventDefault();

        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();

        if(start_date == '' || end_date == '') {
            toastr.warning('Tanggal awal dan akhir harus diisi');
        }
        else {
            $('#transactionTable').DataTable().destroy();

            renderTransactionTable(start_date, end_date);
        }
    });

    renderTransactionTable();

</script>