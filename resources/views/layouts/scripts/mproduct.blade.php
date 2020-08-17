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

    //MPRODUCT - BARCODE
    $(document).ready(function() {
        let id;
        let code = $('#p_code');
        let name = $('#p_name');
        let total = $("#total");

        $('.button-select-item').on('click', function() {
            id = $(this).attr('id');    
            
            $.ajax({
                type: 'GET',
                url: `{{ url("barcode/product") }}/${id}`,
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
                                grid-template-columns: repeat(10, 120px);
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

    //MPRODUCT - CATEGORY
    $('#add-category-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:'POST',
            url: '{{ route('category.store') }}',
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
            data: $(this).serialize(),
            success: function(data) {
                successResponse(data);
            },
            error: function(data) {
                validateData(data.responseJSON.errors.unit_name, '.edit-unit-name-error', '.edit-unit-name-modal-error');
            }
        });
    });

</script>