<script>

    //MBRANCH - GLOBAL
    let preloader = '{{ asset('public/adminlte/assets/images') }}/data-preloader.gif';

    //MBRANCH - BRANCH
    $('#add-branch-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('branch.store') }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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

    //MBRANCH - BRANCH PRODUCT
    let branchProductList = $('#branchProductList tbody');

    let product_list = [];

    function addProductToList(p_id, p_code, p_name, p_price) {
        product_list.push({
            p_id: p_id,
            p_code: p_code,
            p_name: p_name,
            p_price: p_price
        });
    }

    function renderProductList() {
        let html = '';

        product_list.forEach(function(item) {
            let code = item.p_code;
            let name = item.p_name;
            let price = item.p_price;

            html +=
            `
            <tr>

                <td>

                    ${name} <span class="text-indigo">[${code}]</span>

                </td>

                <td>

                    ${moneyFormat(price)}

                </td>

                <td>

                    <button class="button-s1 button-delete-list btn-remove" data-remove="${code}">

                        <i class="fas fa-minus-square mr-1"></i> Hapus

                    </button>
            
                </td>

            </tr>
            `;
        });

        branchProductList.html(html);
    }

    function checkProductExist(code) {
        let unique = 1;

        product_list.forEach(function(item, index) {
            if(item.p_code == code) {

                unique = 0;
                
                return unique;
            }
        });

        return unique;
    }

    function filterProductList(code) {
        let new_list = product_list.filter(item => item.p_code != code);

        product_list = new_list;

        renderProductList();
    }

    function searchProduct() {
        let path = "{{ url('branch/search/product') }}";
        
        $('#branchProductInput').typeahead({ 
            hint: true,
            items: 10,
            source: function(query, process) {
                return $.get(path, { b_id: $('#b_id').val() }, function(data) {
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
                if(checkProductExist(data.p_code) == 1) {
                    addProductToList(data.p_id, data.p_code, data.p_name, data.p_price);
                }
            
                renderProductList();

                $('#branchProductInput').val('');
            }
        });
    }

    function returnProduct(item) {
        return `${item.p_name} - ${item.p_code}`;
    }

    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: "{{ url('branch/'.Request::segment(2).'/product/get') }}",
            data: {},
            success: function(data) {
                if(data.branch != null) {
                    data.branch.products.forEach(function(item) {
                        addProductToList(item.pivot.p_id, item.p_code, item.p_name, item.p_price);
                    });

                    renderProductList();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '.btn-remove', function() {
        let code = $(this).data('remove');
    
        filterProductList(code);
    });

    $('#branchProductInput').on('input', function() {
        if($('#b_id').val() == '') {
            toastr.warning('Cabang belum dipilih');

            $(this).val('');

            return false;
        }
    });

    $('#btn-disactive').on('click', function() {
        if(product_list.length < 1) {
            toastr.error('Belum ada produk yang dipilih');

            return false;
        }
    });

    $('#add-branch-product-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: "{{ route('branch-product.store') }}",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                b_id: $('#b_id').val(),
                products: product_list
            },
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                $('.modal').modal('hide');

                validateData(data.responseJSON.errors.b_id, '.add-b-id-error', '.add-b-id-modal-error');
            }
        });
    });

    $('#edit-branch-product-form').on('submit', function(e) {
        e.preventDefault();

        let id = $('#b_id').val();

        let url = '{{ route('branch-product.update', ':id') }}';

        $.ajax({
            type: 'PATCH',
            url: url.replace(':id', id),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                b_id: id,
                products: product_list
            },
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                $('.modal').modal('hide');

                validateData(data.responseJSON.errors.b_id, '.edit-b-id-error', '.edit-b-id-modal-error');
            }
        });
    });

    searchProduct();

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

</script>