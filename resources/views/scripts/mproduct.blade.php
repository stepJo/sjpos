<script>
    
    //MPRODUCT - GLOBAL
    let preloader = '{{ asset('public/adminlte/assets/images') }}/data-preloader.gif';

    //MPRODUCT - CATEGORY
    $('#add-category-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('category.store') }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.cat_name, '.add-cat-name-error', '.add-cat-name-modal-error');
            }
        });
    });

    $('.edit-category-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('category.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.cat_name, '.edit-cat-name-error', '.edit-cat-name-modal-error');
            }
        });
    });

    //MPRODUCT - UNIT
    $('#add-unit-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('unit.store') }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.unit_name, '.add-unit-name-error', '.add-unit-name-modal-error');
            }
        });
    });

    $('.edit-unit-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('unit.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.unit_name, '.edit-unit-name-error', '.edit-unit-name-modal-error');
            }
        });
    });

    //MPRODUCT - PRODUCT
    $('#productTable').DataTable({
        autoWidth: false,
        responsive: true,
        ordering: true,
        order: [[ 2, 'asc' ]],
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

    //MPRODUCT - BARCODE
    $('#barcodeTable').DataTable({
        autoWidth: false,
        ordering: true,
        order: [[ 0, 'asc' ]],
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url: "{{ route('barcode.index') }}",
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
        columns: 
        [
            {
                data: 'p_code',
                name: 'p_code'
            },
            {
                data: 'p_name',
                name: 'p_name'
            },
            {
                data: 'barcode',
                name: 'barcode'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });

    $(document).ready(function() {
        let id;
        let code = $('#p_code');
        let name = $('#p_name');
        let total = $("#total");

        $(document).on('click', '.button-select-item', function() {
            id = $(this).attr('id');    

            let url = '{{ route('product-barcode.get', ':id') }}';

            $.ajax({
                type: 'GET',
                url: url.replace(':id', id),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { p_id: id },
                success: function(data) {
                    name.val(data.p_name);
                    code.val(data.p_code);
                },
                error: function() {
                    toastr.error("Error");
                }
            });
        });

        $('#button-print').on('click', function() {
            if(code.val() == '' || name.val() == '') {
                toastr.error("Produk belum diplih !");
            }
            else if(total.val() == '' || total.val() < 0 || total.val() > 50) {
                toastr.error("Jumlah harus lebih besar dari 0 dan maksimum 50 !");
            }
            else if(isNaN(total.val())) {
                toastr.error("Jumlah harus angka !");
            }
            else {
                let printSide = $(`#print-side${id}`);
                
                let html = '';
                
                for(let i = 0; i < total.val(); i++) {
                    html += `<br><br>${printSide.html()}`;
                }

                let newWin = window.open('','Print-Window');

                newWin.document.open();

                newWin.document.write(
                    
                    `<body onload="window.print()">

                        <style>

                            div {
                                display: grid;
                                grid-template-columns: repeat(auto-fill, minmax(120px, 150px));
                                grid-auto-rows: 120px;
                            }
                            
                        </style>

                        <div>

                            ${html}

                        </div>

                    </body>`
                );
          
                newWin.document.close();
            }
        });
    });


</script>