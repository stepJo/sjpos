<script>

    let productList = $('#productList tbody');
    let productGrid = $('.product-grid');

    let shopping_list = [];

    let final_tax = 0;

    checkProductList();

    function renderProductGrid(data) {
        let html = '';

        if($.isEmptyObject(data.products)) {
            html += 
            `   
                <h5 class="font-weight-bold mt-3 ml-3" style="width:180px;">Tidak ada produk...<h5>
            `;
        }

        else {
            data.products.forEach(function(item) {
                let layer = '';
                let image;
                let button = '';
                let priceField = '';

                data.discounts.forEach(function(discount) {
                    if(discount.p_id == item.p_id && discount.dp_status == 1) {
                        priceField +=
                        `
                        <span class="price-cut">${moneyFormat(item.p_price)}</span>

                        <div class="product-price-promo">

                            <span class="cost-price" data-price="${(item.p_price - discount.dp_value)}">

                                ${moneyFormat(item.p_price - discount.dp_value)}

                            </span>

                        </div>
                        `;

                        return;
                    }
                });

                if(priceField == '') {
                    priceField +=
                    `<span class="cost-price" data-price="${item.p_price}">

                        ${moneyFormat(item.p_price)}

                    </span>
                    `;
                }

                if(item.p_image != null) {
                    image = `{{ asset('public/uploads/images/products') }}/${item.p_image}`;
                }
                else {
                    image = `{{ asset('public/uploads/images/no_image.jpg') }}`;
                }

                if(item.p_status == 0) {
                    layer = 
                    `
                    <div class="layer-off">
                            
                        <p>Tidak Aktif</p>

                    </div>
                    `;
                }

                if(item.p_status != 0) {
                    button = 
                    `
                    <button class="add-item btn btn-secondary mt-2" data-product="${item.p_id}">Pilih</button>
                    `;
                }

                html +=
                `
                <div class="product-card" id="product-data-${item.p_id}">

                    <div class="product-thumb">
                                            
                        ${layer}

                        <img src="${image}" class="thumbnail">

                    </div>

                    <div class="product-details">

                        <span class="product-code" data-code="${item.p_code}">${item.p_code}</span>
                        
                        <h4 class="product-name" data-name="${item.p_name}">${item.p_name}</h4>
                        
                        <div class="product-bottom-details">
                            
                            <div class="product-price">

                                ${priceField}

                            </div>

                        </div>

                    </div>

                    ${button}

                </div>
                `;
           }); 
        } 

        productGrid.html(html);
    }

    $('.btn-category').on('click', function() {
        $('#panel-category').addClass('on');
    });

    $('.btn-unit').on('click', function() {
        $('#panel-unit').addClass('on');
    });

    $('.close-icon').on('click', function() {
        $('#panel-category').removeClass('on');
        $('#panel-unit').removeClass('on');
        $('#panel-unit').removeClass('on');
    });

    $('.filter-category').on('click', function() {
        let cat_id = $(this).data('category');

        $.ajax({
            type: 'GET',
            url: '{{ url("pos/search/category") }}',
            data: { cat_id: cat_id },
            success: function(data) {
                renderProductGrid(data);

                $('#panel-category').removeClass('on');
            },
            error: function() {
                toastr.error("Error");
            }
        });
    });

    $('.filter-unit').on('click', function() {
        let unit_id = $(this).data('unit');

        $.ajax({
            type: 'GET',
            url: '{{ url("pos/search/unit") }}',
            data: { unit_id: unit_id },
            success: function(data) {
                renderProductGrid(data); 

                $('#panel-unit').removeClass('on');
            },
            error: function() {
                toastr.error("Error");
            }
        });
    });

    $('.show-all-product').on('click', function() {
        $.ajax({
            type: 'GET',
            url: '{{ url("pos/search/all") }}',
            success: function(data) {
                let html = '';

                data.forEach(function(item) {
                    let layer = '';
                    let image;
                    let button = '';
                    let priceField = '';

                    if(item.p_image != null) {
                        image = `{{ asset('public/uploads/images/products') }}/${item.p_image}`;
                    }
                    else {
                        image = `{{ asset('public/uploads/images/no_image.jpg') }}`;
                    }

                    if(item.discount != null && item.discount.dp_status == 1) {
                        priceField +=
                        `
                        <span class="price-cut">${moneyFormat(item.p_price)}</span>

                        <div class="product-price-promo">

                            <span class="cost-price" data-price="${(item.p_price - item.discount.dp_value)}">

                                ${moneyFormat(item.p_price - item.discount.dp_value)}

                            </span>

                        </div>
                        `;
                    }
                    else {
                        priceField +=
                        `<span class="cost-price" data-price="${item.p_price}">

                            ${moneyFormat(item.p_price)}

                        </span>
                        `;
                    }                    

                    if(item.p_status == 0) {
                        layer = 
                        `
                        <div class="layer-off">
                                
                            <p>Tidak Aktif</p>

                        </div>
                        `;
                    }

                    if(item.p_status != 0) {
                        button = 
                        `
                        <button class="add-item btn btn-secondary mt-2" data-product="${item.p_id}">Pilih</button>
                        `;
                    }

                    html +=
                    `
                    <div class="product-card" id="product-data-${item.p_id}">

                        <div class="product-thumb">
                                                
                            ${layer}

                            <img src="${image}" class="thumbnail">

                        </div>

                        <div class="product-details">

                            <span class="product-code" data-code="${item.p_code}">${item.p_code}</span>
                            
                            <h4 class="product-name" data-name="${item.p_name}">${item.p_name}</h4>
                            
                            <div class="product-bottom-details">
                                
                                <div class="product-price">

                                    ${priceField}

                                </div>

                            </div>

                        </div>

                        ${button}

                    </div>
                    `;
                }); 

                productGrid.html(html);

                $('#panel-category').removeClass('on');
                $('#panel-unit').removeClass('on');
            },
            error: function() {
                toastr.error("Error");
            }
        });
    });

    function addProductToList(p_id, p_code, p_name, p_price, qty) {
        shopping_list.push({
            p_id: p_id,
            p_code: p_code,
            p_name: p_name,
            p_price: p_price,
            p_qty: qty
        });
    }

    function checkProductList() {
        if($.isEmptyObject(shopping_list)) {
            let html = 
            `
            <div class="row">

                <div class="offset-md-6 col-md-12 pt-5">

                    <div id="product-shopping-empty">

                        <h5 class="font-weight-bold text-danger text-center"><i class="fas fa-cart-plus"></i> Daftar belanja kosong</h5>

                    </div>

                </div>

            </div>
            `;

            productList.html(html);
        }

        return $.isEmptyObject(shopping_list);
    }

    function filterProductList(code) {
        let new_list = shopping_list.filter(item => item.p_code != code);

        shopping_list = new_list;

        renderProductList();
    }

    function renderProductList() {
        if(!checkProductList()) {

            let html = '';

            shopping_list.forEach(function(item) {
                let code = item.p_code;
                let price = item.p_price;
                let qty = item.p_qty;

                html +=
                `
                <tr>

                    <td>

                        ${item.p_name} <span class="text-indigo">[${item.p_code}]</span>

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

            productList.html(html);
        }

        trackTotalPayment();
    }

    function trackTotalPayment(render = true) {
        let subtotal = 0;
        let tax = 0;
        let grandtotal = 0;

        shopping_list.forEach(function(item) {
            subtotal += (item.p_price * item.p_qty);
        });

        tax = parseInt(((subtotal + (subtotal * 0.1)) - subtotal));

        final_tax = tax;

        grandtotal = parseInt(tax + subtotal);

        if(render == true) {

            $('#total-product').text(`${shopping_list.length}`);

            $('#subtotal').text(moneyFormat(subtotal));

            $('#tax').text(`10% (${moneyFormat(final_tax)})`);

            $('#grand-total').text(`${moneyFormat(grandtotal)}`);

            $('#modal-grand-total').html(`Total : <span class="ml-1">${moneyFormat(grandtotal)}</span>`);
        
            $('#modal-tax').html(`Pajak : <span class="ml-1">10% ( ${moneyFormat(tax)} )</span>`);
        }

        return grandtotal;
    }

    function updateProductQty(code , action, qty = 1, press_event = false) {
        let unique = 1;

        shopping_list.forEach(function(item, index) {
            if(item.p_code == code) {
                if(press_event == false) {
                    if(action == '+') {
                        shopping_list[index].p_qty += qty;
                    }
                    else if(action == '-') {
                       shopping_list[index].p_qty -= qty; 
                    }
                }
                else {
                    shopping_list[index].p_qty = qty;
                }

                unique = 0;
                
                return unique;
            }
        });

        return unique;
    }

    $(document).on('click', '.add-item', function() {
        let id = $(this).data('product');

        let p_code = $(`#product-data-${id}`).find('.product-code').data('code');
        let p_name =  $(`#product-data-${id}`).find('.product-name').data('name');
        let p_price = $(`#product-data-${id}`).find('.cost-price').data('price');

        if(updateProductQty(p_code, '+') == 1) {    
            addProductToList(id, p_code, p_name, p_price, 1);
        }
            
        renderProductList();
    });

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
    
    $('.btn-cash, .btn-ovo, .btn-gopay, .btn-credit').on('click', function() {
        if(shopping_list.length < 1) {
            toastr.warning('Daftar belanja kosong');
        }
        else {
            let html = '';

            shopping_list.forEach(function(item) {
                let code = item.p_code;
                let price = item.p_price;
                let qty = item.p_qty;

                html +=
                `
                <tr>

                    <td>

                        ${item.p_name} <span class="text-indigo">[${item.p_code}]</span>

                    </td>

                    <td>

                        ${qty}

                    </td>

                    <td>

                        ${moneyFormat(price)}

                    </td>

                    <td>

                        <span class="font-weight-bold text-secondary">${moneyFormat(price * qty)}</span>
                
                    </td>

                </tr>
                `;
            });

            $("#payModal").find('tbody').html(html);

            $("#payModal").modal('show');
        }
    });

    //CALCULATOR
    $('.btn-calculator, .calc-close-icon').on('click', function() {
        $('.calculator').toggleClass('on');
    });

    const calc = {
        displayPrevContent: "",
        displayContent: "0",
        numbers: [],
        number: "0",
        operators: [],
        operations: [],
        operator: "",
        opSelected: false,
    };

    function primeFactorize(number) {
        const pfArray = [];
      
        for(let i = 2; i <= number / i; i++) {
            while (number % i == 0) { 
            
                number /= i;
          
                pfArray.push(i);
            }
        }
        
        if(number > 1) { 
            pfArray.push(number);
        }
        
        return pfArray;
    }

    function resetCalc() {
        calc.displayContent = "0";
        calc.numbers = [];
        calc.number = "0";
        calc.operators = [];
        calc.operations = [];
        calc.operator = "";
        calc.opSelected = false;
    }

    function setDisplayContent(elem) {
        let formula = "";

        if(calc.numbers.length >= 1) {
            for(let i = 0; i < calc.numbers.length; i++) {
                formula += calc.numbers[i];
            
                if(calc.operators.length > i) {
                    formula += calc.operators[i]
                }
            }
        
            formula += elem;
        } 
        else {
            formula = elem;
        }
      
        calc.displayContent = formula;
    }

    function setOperator(action) {
        let operation = "";
        
        switch(action) {
            case "multiply":
                operation = "*";
                break;
        
            case "divide":
                operation = "/";
                break;
            case "modulo":
                operation = "%";
                break;
            case "add":
                operation = "+";
                break;
            case "subtract":
                operation = "-";
        }
      
        return operation;
    }

    function updateDisplay() {
        const display = document.querySelector(".calc-display");
      
        display.value = calc.displayContent;
    }


    function updatePrevDisplay() {
        const prevDisplay = document.querySelector(".calc-display-prev");
      
        if(calc.displayContent != "0") {
            prevDisplay.value = calc.displayPrevContent;
      
        } 
        else {
            prevDisplay.value = "";
        }
    }

    const calculator = document.querySelector(".calculator");
    
    const keys = $(".calc-keys");
    
    keys.on("click", event => {
        if(!event.target.matches("button")) {
            return;
        }
      
        const key = event.target;
      
        const action = key.dataset.action;
      
        if(!action) {
            if(calc.number == "0") {
                calc.number = key.value;
            } 
            else { 
          
                if(key.value != "\u03C0" && calc.number != "\u03C0") {
                    calc.number += key.value;
                }
                else {
                    return;
                }
            }

            setDisplayContent(calc.number);
                
            calc.opSelected = false;
        }

        if(action === "decimal" && !calc.number.includes(key.value) && calc.number != "\u03C0") {
            calc.number += key.value;
            
            setDisplayContent(calc.number);
        }

        if(key.classList.contains("key-op")) {
            if (!calc.opSelected) {
                    
                calc.operator = key.textContent;
                
                calc.opSelected = true;
                
                calc.numbers.push(calc.number); 
                
                calc.number = "0"; 
              
                setDisplayContent(calc.operator);
          
                calc.operators.push(calc.operator); 
                calc.operations.push(setOperator(action));

                calc.operator = "";
            } 
            else {
                return;
            }
        }

        if(action === "calculate") {
            const values = [];

            calc.numbers.forEach(function(value, index) {
                values.push(value);
                values.push(calc.operations[index]);
            });

            values.push(calc.number);
            
            const calculation = values.join("");
            
            const calculationPi = calculation.replace(/\u03C0/g, Math.PI);
            
            const result = eval(calculationPi);

            setDisplayContent(calc.number + " " + key.value + " " + result);

            calc.displayPrevContent = calc.displayContent;

            updatePrevDisplay();
        
            resetCalc();

            calc.number = result;

            setDisplayContent(calc.number);
        }

        if(action === "prime-factorization") {
           
            if(calc.number < 1 || calc.number.includes(".") || calc.number.includes("\u03C0")) {
                calc.displayPrevContent = "Try a positive Integer :-)";
              
                updatePrevDisplay();
                
                resetCalc();      
            } 
            else {
                const factors = primeFactorize(calc.number);
                
                calc.displayPrevContent = "Prime Factors of " + calc.number + ":";
                
                updatePrevDisplay();
                
                calc.displayContent = factors.join();
            }
        }

        if(action === "clear") {
            resetCalc();
            
            updatePrevDisplay();
        }

        updateDisplay();
    });

    //DISCOUNT
    function calcAfterDiscount(type, disc) {
        let final;

        let total = $('#modal-grand-total').text();
        
        total = total.substr(10, total.length);

        if(type == 'Nominal') {
            final = parseInt(trackTotalPayment() - disc);

            $('#fix-disc-amount').val(parseInt(trackTotalPayment()) - final);
        }
        else {
            final = parseInt(trackTotalPayment() - (trackTotalPayment() * (disc / 100)));

            $('#percent_value_amount').val(parseInt(trackTotalPayment()) - final);
        }

        $('#modal-grand-total').html(`Total : <span class="ml-1">${moneyFormat(final)}</span>`);
    }

    $('#fix-dc').on('click', function() {
        $('#fix-disc-amount').addClass('active');
        $('#percent-disc-amount').removeClass('active');
        $('#percent-disc-amount').val('');
    });

    $('#percent-dc').on('click', function() {
        $('#percent-disc-amount').addClass('active');
        $('#fix-disc-amount').removeClass('active');
        $('#fix-disc-amount').val('');
    });

    $('#fix-disc-amount').on('blur input', function() {
        let disc = $(this).val();

        if(isNaN(disc) || disc > trackTotalPayment(true)) {
            toastr.error('Nominal tidak valid');

            $(this).val('0');
        }
        else {
            calcAfterDiscount('Nominal', disc);
        }
    });

    $('#percent-disc-amount').on('blur input', function() {
        let disc = $(this).val();

        if(isNaN(disc) || disc > 100) {
            toastr.error('Persen tidak valid');
                
            trackTotalPayment(true)
                
            $(this).val('0');
        }
        else {
            calcAfterDiscount('Percent', disc);
        }
    });

    //PAYMENT
    function cashExchange() {
        let cash_amount = $('#pay-amount').val();

        let total = $('#modal-grand-total').text();

        total = total.substr(10, total.length);

        $('#return-amount').val(cash_amount - (total * 1000));
    }

    function validateCashPayment(pay_amount, total, exchange) {
        if(isNaN(pay_amount)) {
            toastr.error('Nominal tidak valid');

            return false;
        }
        else if(pay_amount < total || exchange < 0) {
            toastr.error('Jumlah bayar kurang');
            
            return false;
        }
    }

    function validateCreditCardNumber() {
        if(!$.payform.validateCardNumber(cc.val()) || $.payform.parseCardType(cc.val()) == null) {
            toastr.error('Nomor kartu tidak valid');

            cc.val('');

            return false;
        }
        else {
            return true;
        }
    }

    function validateCreditCardCCV() {
        if(!$.payform.validateCardCVC(cvc.val())) {
            toastr.error('Nomor CVC tidak valid');

            cvc.val('');

            return false;
        }
        else {
            return true;
        }
    }

    $('#pay-amount').on('input', function() {
        cashExchange();
    });

    let cc = $('#credit-card-number');
    let cvc = $('#credit-card-cvc');

    cc.payform('formatCardNumber');

    cc.on('change', function() {
        validateCreditCardNumber();
    });

    cvc.on('change', function() {
        validateCreditCardCCV();
    });

    $('#btn-pay').on('click', function() {
        let discount = 0;

        if($('#fix-disc-amount').val() > 0) {
            discount = $('#fix-disc-amount').val();
        }
        else if($('#percent_value_amount').val() > 0) {
            discount = $('#percent_value_amount').val();
        }

        let pay_type = $('.pws_tabs_controll').find('li a.pws_tab_active').data('tab-id');

        let pay_amount = $('#pay-amount').val();

        let total = $('#modal-grand-total').text();

        total = total.substr(10, total.length);
        
        let exchange = $('#return-amount').val();
        
        let valid_payment = '';
    
        if(pay_type == 'tab1') {
            if(validateCashPayment(pay_amount, total, exchange) == false) {
                valid_payment = '';

                return;
            }
            else {
                valid_payment = 'Tunai';
            }
        }        
        else if(pay_type == 'tab2') {
            if(validateCreditCardNumber() == false || validateCreditCardCCV() == false) {
                valid_payment = '';

                return;
            }
            else {
                valid_payment = 'Kartu Kredit';
            }
        }

        $('#t_total').val(total);

        let t_type = '';

        if(valid_payment == 'Kartu Kredit') {
            t_type = 'Kartu Kredit';
            
            console.log(t_type);
        }
        else {
            t_type = 'Tunai';
        } 

        $.ajax({
            type: 'POST',
            url: '{{ url('pos/transaction/store') }}',
            data: {
                _token: "{{ csrf_token() }}", 
                t_type: t_type,
                t_total: parseInt($('#t_total').val().toString().split('.').join("")),
                t_tax: parseInt(final_tax),
                t_disc: discount,
                products: shopping_list 
            },
            success: function(data) {
                $('#payModal').modal('hide');

                toastr.success(data);
                
                setTimeout(function() {
                    location.reload(true);
                }, 500);
            },
            error: function() {
                console.log('error');
            }
        });
    });

    //SEARCH
    let path = "{{ url('pos/search/product') }}";

    function returnProduct(item) {
        if(item.p_status == 1) return `${item.p_name} - ${item.p_code}`;
        else return `${item.p_name} - ${item.p_code} ( Tidak Aktif )`;
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
            if(data.p_status == 1) {
                let price = data.p_price;
                
                if(data.discount && data.discount.dp_status == 1) {
                    price = data.p_price - data.discount.dp_value;
                }
                
                if(updateProductQty(data.p_code, '+') == 1) {
                    addProductToList(data.p_id, data.p_code, data.p_name, price, 1);
                }
        
                renderProductList();
            }
            
            $('input[name="p_id"], #p_id').val(data.p_id);

            $('.searchInput').val('');
        }
    });

</script>