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

        function renderProductSupplierTable(start_date = '', end_date = '') {
            $('#productSupplierTable').DataTable({
                autoWidth: false,
                ordering: true,
                order: [[ 0, 'asc' ]],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: 
                {
                    url: "{{ route('product-supplier.index') }}",
                    data:{ start_date:start_date, end_date:end_date }
                },
                language: 
                {
                    info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ barang</span>",
                    infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                    infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ barang)</span>",
                    paginate: 
                    {
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>"
                    },
                    processing: `<img src="${preloader}">`,
                    search: "<span class='font-weight-bold'>Cari barang : </span>",
                    searchPlaceholder: "...",
                    zeroRecords: "<span class='font-weight-bold'>Barang tidak ditemukan</span>",
                },
                oLanguage: 
                {
                sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ barang</span>",
                },
                columns: 
                [
                    {
                        data: 'ps_name',
                        name: 'ps_name'
                    },
                    {
                        data: 'ps_code',
                        name: 'ps_code'
                    },
                    {
                        data: 'ps_price',
                        name: 'ps_price'
                    },
                    {
                        data: 'ps_desc',
                        name: 'ps_desc'
                    },
                    {
                        data: 'supplier.s_name',
                        name: 'supplier.s_name'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },
                ]
            });
        }

        function renderPurchasementSupplierTable(start_date = '', end_date = '', supplier = '') {
            $('#purchasementSupplierTable').DataTable({
                autoWidth: false,
                ordering: true,
                order: [[ 2, 'desc' ]],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: 
                {
                    url: "{{ route('purchasement-supplier.index') }}",
                    data:{ start_date:start_date, end_date:end_date, supplier:supplier }
                },
                fnDrawCallback: function() {
                    let api = this.api();
                    
                    let json = api.ajax.json();

                    $(api.column().footer()).html(`<h5 class="font-weight-bold my-2">Total Biaya : <span class="ml-2 text-danger">${moneyFormat(json.sum_pch_cost)}</span></h5>`);
                },
                language: 
                {
                    info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ pembelian barang</span>",
                    infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                    infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ pembelian barang)</span>",
                    paginate: 
                    {
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>"
                    },
                    processing: `<img src="${preloader}">`,
                    search: "<span class='font-weight-bold'>Cari pembelian barang : </span>",
                    searchPlaceholder: "...",
                    zeroRecords: "<span class='font-weight-bold'>Pembelian barang tidak ditemukan</span>",
                },
                oLanguage: 
                {
                sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ pembelian barang</span>",
                },
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-id', data.pch_id);
                    $(row).find('td:last-child').addClass('actions');
                },
                columns: 
                [
                    {
                        data: 'pch_code',
                        name: 'pch_code'
                    },
                    {
                        data: 'pch_cost',
                        name: 'pch_cost'
                    },
                    {
                        data: 'pch_date',
                        name: 'pch_date'
                    },
                    {
                        data: 'supplier.s_name',
                        name: 'supplier.s_name'
                    },
                    {
                        data: 'pch_note',
                        name: 'pch_note'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },
                ]
            });
        }

        function renderTransactionTable(start_date = '', end_date = '') {
            $('#transactionTable').DataTable({
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

        $('#type-filter li').on('click', function(e) {
            e.preventDefault();

            filterType(1);

            setTimeout(function() {
                masterTable.draw(false); 
            }, 300);
        });

        $("#branchTable, #masterTable, #productTable, #purchasementSupplierTable, #transactionTable").on('mouseover', 'td', function() {
            $(this).on('click', function() {
                let id = $(this).closest('tr').data('id');

                if(!$(this).hasClass('actions') && !$(this).hasClass('toggle')) {
                    $(`#detModal${id}`).modal('show'); 
                }
            });
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
            order: [[ 2, 'asc' ]],
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

        $('#branchTable').DataTable({
            autoWidth: false,
            ordering: true,
            order: [[ 0, 'asc' ]],
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: 
            {
                url: "{{ route('branch.index') }}",
            },
            language: 
            {
                info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ cabang</span>",
                infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ cabang)</span>",
                paginate: 
                {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                },
                processing: `<img src="${preloader}">`,
                search: "<span class='font-weight-bold'>Cari cabang : </span>",
                searchPlaceholder: "...",
                zeroRecords: "<span class='font-weight-bold'>Cabang tidak ditemukan</span>",
            },
            oLanguage: 
            {
              sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ cabang</span>",
            },
            createdRow: function (row, data, dataIndex) {
                $(row).attr('data-id', data.b_id);
                $(row).find('td:last-child').addClass('actions');
            },
            columns: 
            [
                {
                    data: 'b_name',
                    name: 'b_name'
                },
                {
                    data: 'b_email',
                    name: 'b_email'
                },
                {
                    data: 'b_contact',
                    name: 'b_contact'
                },
                {
                    data: 'b_address',
                    name: 'b_address'
                },
                {
                    data: 'b_status',
                    name: 'b_status'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]
        });

        $('#branchProductTable').DataTable({
            autoWidth: false,
            ordering: true,
            order: [[ 0, 'asc' ]],
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: 
            {
                url: "{{ route('branch-product.index') }}",
            },
            language: 
            {
                info: "<span class='font-weight-bold'>Menampilkan _START_ - _END_ dari _TOTAL_ cabang</span>",
                infoEmpty: "<span class='font-weight-bold'>Tidak ada data</span>",
                infoFiltered: "<span class='font-weight-bold'>(Filter dari _MAX_ cabang)</span>",
                paginate: 
                {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                },
                processing: `<img src="${preloader}">`,
                search: "<span class='font-weight-bold'>Cari cabang : </span>",
                searchPlaceholder: "...",
                zeroRecords: "<span class='font-weight-bold'>Cabang tidak ditemukan</span>",
            },
            oLanguage: 
            {
              sLengthMenu: "<span class='font-weight-bold'>Menampilkan _MENU_ cabang</span>",
            },
            createdRow: function (row, data, dataIndex) {
                $(row).attr('data-id', data.b_id);
                $(row).find('td:last-child').addClass('actions');
            },
            columns: 
            [
                {
                    data: 'b_name',
                    name: 'b_name'
                },
                {
                    data: 'b_status',
                    name: 'b_status'
                },
                {
                    data: 'details',
                    name: 'details'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]
        });

        $('#btn-search-prodsupp').on('click', function(e) {
            e.preventDefault();

            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            if(start_date == '' || end_date == '') {
                toastr.warning('Tanggal awal dan akhir harus diisi');
            }
            else {
                $('#productSupplierTable').DataTable().destroy();

                renderProductSupplierTable(start_date, end_date);
            }
        });

        $('#btn-search-pchsupp').on('click', function(e) {
            e.preventDefault();

            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            let supplier = $('#supplier').val();

            if(start_date == '' || end_date == '') {
                toastr.warning('Tanggal awal dan akhir harus diisi');
            }
            else {
                $('#purchasementSupplierTable').DataTable().destroy();
                
                renderPurchasementSupplierTable(start_date, end_date, supplier);
            }
        });
        
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

        renderProductSupplierTable();
        renderPurchasementSupplierTable();
        renderTransactionTable();
    });

</script>