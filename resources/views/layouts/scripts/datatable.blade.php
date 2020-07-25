<script>

    $(document).ready(function() {
        let preloader = '{{ asset('public/adminlte/assets/images') }}/data-preloader.gif';

        function filterType(column) {
            $.fn.dataTableExt.afnFiltering.push(
                function( oSettings, aData, iDataIndex) {
                    let filter = aData[column].trim();
                    
                    let type = $('#dis_type').val();

                    if(type == '*') {
                        return true;
                    }
                    else if(filter == type) {
                        return true;
                    }

                    return false;
                }
            );
        }

        $("#masterTable, #productTable, #transactionTable").on('mouseover', 'td', function() {
            $(this).on('click', function() {
                let id = $(this).closest('tr').data('id');

                if(!$(this).hasClass('actions') && !$(this).hasClass('toggle')) {
                    $(`#detModal${id}`).modal('show'); 
                }
            });
        });

        $('#type-filter li').on('click', function(e) {
            e.preventDefault();

            filterType(1);

            setTimeout(function() {
                masterTable.draw(false); 
            }, 300);
        });

        $('#masterTable').DataTable({
            autoWidth: false,
            lengthChange: true,
            ordering: true,
            paging: true,
            searching: true,
            responsive: true,
            language: 
            {
                info: `<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ data</span>`,
                infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ data)</span>",
                paginate: 
                {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                },
                search: `<span class='font-weight-bold'>Cari data : </span>`,
                searchPlaceholder: "...",
                zeroRecords: `<span class='font-weight-bold'>Data tidak ditemukan</span>`,
            },
            oLanguage: 
            {
              sLengthMenu: `<span class='font-weight-bold'>Menampilkan _MENU_ Data</span>`,
            }
        });
        
        $('#productTable').DataTable({
            autoWidth: false,
            ordering: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: 
            {
                url: "{{ route('product.index') }}",
            },
            language: 
            {
                info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ produk</span>",
                infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ produk)</span>",
                paginate: 
                {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                },
                processing: `<img src="${preloader}">`,
                search: "<span class='font-weight-bold'>Cari produk : </span>",
                searchPlaceholder: "...",
                zeroRecords: "<span class='font-weight-bold'>Produk tidak ditemukan</span>",
            },
            oLanguage: 
            {
              sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ produk</span>",
            },
            createdRow: function (row, data, dataIndex) {
                $(row).attr('data-id', data.p_id);
                $(row).find('td:last-child').addClass('actions');
            },
            columns: 
            [
                {
                    data: 'p_code',
                    name: 'p_code'
                },
                {
                    data: 'category.cat_name',
                    name: 'category.cat_name'
                },
                {
                    data: 'p_name',
                    name: 'p_name'
                },
                {
                    data: 'unit.unit_name',
                    name: 'unit.unit_name'
                },
                {
                    data: 'p_price',
                    name: 'p_price'
                },
                {
                    data: 'p_image',
                    name: 'p_image'
                },
                {
                    data: 'p_status',
                    name: 'p_status'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]
        });

        function renderTransactionTable(start_date = '', end_date = '') {
            $('#transactionTable').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: 
                {
                    url: "{{ route('transaction.index') }}",
                    data:{ start_date:start_date, end_date:end_date }
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

        renderTransactionTable();

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
    });

</script>