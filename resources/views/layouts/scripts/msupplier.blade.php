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
        }, 300);
    }

    //MSUPPLIER - SUPPLIER
    $('#add-supplier-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('supplier.store') }}',
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.s_code, '.add-s-code-error', '.add-s-code-modal-error');
                validateData(data.responseJSON.errors.s_name, '.add-s-name-error', '.add-s-name-modal-error');
                validateData(data.responseJSON.errors.s_email, '.add-s-email-error', '.add-s-email-modal-error');
                validateData(data.responseJSON.errors.s_contact, '.add-s-contact-error', '.add-s-contact-modal-error');
                validateData(data.responseJSON.errors.s_bank, '.add-s-bank-error', '.add-s-bank-modal-error');
                validateData(data.responseJSON.errors.s_bank_num, '.add-s-bank-num-error', '.add-s-bank-num-modal-error');
                validateData(data.responseJSON.errors.s_address, '.add-s-address-error', '.add-s-address-modal-error');
            }
        });
    });

    $('.edit-supplier-form').on('submit', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        let url = '{{ route('supplier.update', ':id') }}';

        $.ajax({
            type:'PATCH',
            url: url.replace(':id', id),
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.s_code, '.edit-s-code-error', '.edit-s-code-modal-error');
                validateData(data.responseJSON.errors.s_name, '.edit-s-name-error', '.edit-s-name-modal-error');
                validateData(data.responseJSON.errors.s_email, '.edit-s-email-error', '.edit-s-email-modal-error');
                validateData(data.responseJSON.errors.s_contact, '.edit-s-contact-error', '.edit-s-contact-modal-error');
                validateData(data.responseJSON.errors.s_bank, '.edit-s-bank-error', '.edit-s-bank-modal-error');
                validateData(data.responseJSON.errors.s_bank_num, '.edit-s-bank-num-error', '.edit-s-bank-num-modal-error');
                validateData(data.responseJSON.errors.s_address, '.edit-s-address-error', '.edit-s-address-modal-error');
            }
        });
    });

    //MSUPPLIER - PRODUCT
    $('#add-product-supplier-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('product-supplier.store') }}',
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.ps_name, '.add-ps-name-error', '.add-ps-name-modal-error');
                validateData(data.responseJSON.errors.ps_code, '.add-ps-code-error', '.add-ps-code-modal-error');
                validateData(data.responseJSON.errors.ps_price, '.add-ps-price-error', '.add-ps-price-modal-error');
                validateData(data.responseJSON.errors.s_id, '.add-s-id-error', '.add-s-id-modal-error');
            }
        });
    });

    $(document).on('click', '.edit-product-supplier-form', function() {
        $('.edit-product-supplier-form').on('submit', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            let url = '{{ route('product-supplier.update', ':id') }}';

            $.ajax({
                type:'PATCH',
                url: url.replace(':id', id),
                data: $(this).serialize(),
                success: function(data) {
                    successResponse(data);
                },
                error: function(data) {
                    validateData(data.responseJSON.errors.ps_name, '.edit-ps-name-error', '.edit-ps-name-modal-error');
                    validateData(data.responseJSON.errors.ps_code, '.edit-ps-code-error', '.edit-ps-code-modal-error');
                    validateData(data.responseJSON.errors.ps_price, '.edit-ps-price-error', '.edit-ps-price-modal-error');
                    validateData(data.responseJSON.errors.s_id, '.edit-s-id-error', '.edit-s-id-modal-error');
                }
            });
        });
    });

    //MSUPPLIER - PURCHASEMENT
    let purchasementList = $('#purchasementList tbody');

    let shopping_list = [];

    function addProductToList(ps_id, ps_code, ps_name, supplier, ps_price, qty) {
        shopping_list.push({
            ps_id: ps_id,
            ps_code: ps_code,
            ps_name: ps_name,
            supplier: supplier,
            ps_price: ps_price,
            qty: qty
        });
    }

    function renderProductList() {
        let html = '';

        shopping_list.forEach(function(item) {
            let code = item.ps_code;
            let name = item.ps_name;
            let supplier = item.supplier;
            let price = item.ps_price;
            let qty = item.qty;

            html +=
            `
            <tr>

                <td>

                    ${item.ps_name} <span class="text-indigo">[${item.ps_code}]</span>

                </td>

                <td>

                    ${supplier}

                </td>

                <td>

                    ${moneyFormat(price)}

                </td>

                <td>

                    <div class="num-block" data-minus="${code}">
                        
                        <div class="num-in">
                        
                            <span class="minus dis"></span>
                        
                            <input type="text" class="in-num" data-value="${code}" value="${qty}">
                        
                            <span class="plus"></span>
                        
                        </div>
                    
                    </div>

                </td>

                <td class="price-format">

                    ${moneyFormat(price * qty)} 

                    <button class="button-s1 button-delete-list btn-remove" data-remove="${code}">

                        <i class="fas fa-minus-square mr-1"></i> Hapus

                    </button>
            
                </td>

            </tr>
            `;
        });

        purchasementList.html(html);

        trackTotalPayment();
    }

    function updateProductQty(code , action, qty = 1, press_event = false) {
        let unique = 1;

        shopping_list.forEach(function(item, index) {
            if(item.ps_code == code) {
                if(press_event == false) {
                    if(action == '+') {
                        shopping_list[index].qty += qty;
                    }
                    else if(action == '-') {
                       shopping_list[index].qty -= qty; 
                    }
                }
                else {
                    shopping_list[index].qty = qty;
                }

                unique = 0;
                
                return unique;
            }
        });

        return unique;
    }

    function trackTotalPayment(render = true) {
        let subtotal = 0;

        let tax = parseInt($('#pch_tax').val());
        let discount = parseInt($('#pch_disc').val());
        let shipment = parseInt($('#pch_ship').val());

        shopping_list.forEach(function(item) {
            subtotal += (item.ps_price * item.qty);
        });

        if(!isNaN(tax)) {
            subtotal += tax;
        }

        if(!isNaN(discount)) {
            subtotal -= discount;
        }

        if(!isNaN(shipment)) {
            subtotal += shipment;
        }

        if(render == true) {

            $('#total-purchasement').html(`<span class="font-weight-bold">${moneyFormat(subtotal)}</span>`);
        }

        return subtotal;
    }

    function filterProductList(code) {
        let new_list = shopping_list.filter(item => item.ps_code != code);

        shopping_list = new_list;

        renderProductList();
    }

    function searchProduct() {
        let path = "{{ url('supplier/purchasement/search/product') }}";
        
        $('#purchasementInput').typeahead({ 
            hint: true,
            items: 10,
            source: function(query, process) {
                return $.get(path, { s_id: $('#s_id').val() }, function(data) {
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
                if(updateProductQty(data.ps_code, '+') == 1) {
                    addProductToList(data.ps_id, data.ps_code, data.ps_name, data.supplier.s_name, data.ps_price, 1);
                }
            
                renderProductList();

                $('#purchasementInput').val('');
            }
        });
    }

    function returnProduct(item) {
        return `${item.ps_name} - ${item.ps_code}`;
    }

    function validateInputNumeric(input, message) {
        if(isNaN(input)) {
            toastr.error(message);

            return false;
        }

        return true;
    }

    $(document).on('click', '.btn-remove', function() {
        let code = $(this).data('remove');
    
        filterProductList(code);
    });

    $(document).on('click', '.in-num', function() {
        $(this).on('keypress', function(e) {
            let code = $(this).data('value');
            let key = e.which;
            let qty = $(this).val();
            if(key == 13) {
                if(isNaN(qty)) {
                    toastr.error('Jumlah harus angka !');
                }    
                else {
                    updateProductQty(code, 'x', parseInt(qty), true);
                
                    renderProductList();
                }
            }
        });
    });

    $(document).on('click', '.num-in span', function() {
        let $input = $(this).parents('.num-block').find('input.in-num');
        let code = $(this).closest('.num-block').data('minus');
        let count;

        if($(this).hasClass('minus')) {
            count = parseInt($input.val()) - 1;
          
            if (count < 1) {
                filterProductList(code); 
            }
            else {
                updateProductQty(code, '-');

                renderProductList();
            }
        }
        else {
            updateProductQty(code, '+');

            renderProductList();
        }
    });

    $('#s_id').on('change', function() {
        searchProduct();

        shopping_list = [];

        renderProductList();
    });

    $('#purchasementInput').on('input', function() {
        if($('#s_id').val() == '') {
            toastr.warning('Penyuplai belum dipilih');

            $(this).val('');

            return false;
        }
    });

    $('#pch_tax').on('keyup blur', function() {
        if(!validateInputNumeric($(this).val(), 'Biaya pajak tidak valid')) {
            $(this).val('');
        }
        else {
            trackTotalPayment();
        }
    });

    $('#pch_disc').on('keyup blur', function() {
        if(!validateInputNumeric($(this).val(), 'Nominal diskon tidak valid')) {
            $(this).val('');
        }
        else {
            trackTotalPayment();
        }
    });

    $('#pch_ship').on('keyup blur', function() {
        if(!validateInputNumeric($(this).val(), 'Biaya pengiriman tidak valid')) {
            $(this).val('');
        }
        else {
            trackTotalPayment();
        }
    });

    $('#btn-pay').on('click', function() {
        if(shopping_list.length < 1) {
            toastr.error('Belum ada barang yang dipilih');

            return false;
        }
        else {
            let total = trackTotalPayment();

            let tax = parseInt($('#pch_tax').val());
            let discount = parseInt($('#pch_disc').val());
            let shipment = parseInt($('#pch_ship').val());

            $('#total-pay').html(`Total : ${moneyFormat(total)}`);
            $('#tax-pay').html(`Pajak : ${moneyFormat(tax)}`);
            $('#discount-pay').html(`Diskon : ${moneyFormat(discount)}`);
            $('#shipment-pay').html(`Pengiriman : ${moneyFormat(shipment)}`);
        }
    });

    $('#add-purchasement-supplier-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '{{ url('supplier/purchasement/store') }}',
            data: {
                _token: "{{ csrf_token() }}", 
                pch_code: $('#pch_code').val(),
                pch_cost: trackTotalPayment(),
                pch_tax: parseInt($('#pch_tax').val()),
                pch_disc: parseInt($('#pch_disc').val()),
                pch_ship: parseInt($('#pch_ship').val()),
                s_id: $('#s_id').val(),
                pch_note: $('#pch_note').val(),
                products: shopping_list
            },
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                $('.modal').modal('hide');

                validateData(data.responseJSON.errors.pch_code, '.add-pch-code-error', '.add-pch-code-modal-error');
                validateData(data.responseJSON.errors.s_id, '.add-s-id-error', '.add-s-id-modal-error');
                validateData(data.responseJSON.errors.pch_tax, '.add-pch-tax-error', '.add-pch-tax-modal-error');
                validateData(data.responseJSON.errors.pch_disc, '.add-pch-disc-error', '.add-pch-disc-modal-error');
                validateData(data.responseJSON.errors.pch_ship, '.add-pch-ship-error', '.add-pch-ship-modal-error');
            }
        });
    });

</script>