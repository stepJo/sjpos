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
        }, 2000);
    }

    //MBRANCH - BRANCH
    $('#add-branch-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('branch.store') }}',
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

    //MBRANCH - PRODUCT BRANCH
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
            url: '{{ url('branch/'.Request::segment(2).'/product/get') }}',
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
            url: '{{ url('branch/product/store') }}',
            data: {
                _token: "{{ csrf_token() }}", 
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
            data: {
                _token: "{{ csrf_token() }}", 
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

</script>