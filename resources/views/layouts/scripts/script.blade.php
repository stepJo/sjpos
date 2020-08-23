<script>

    //CLOCK
    function startTime() {
        let today = new Date();

        let day = today.getDate();
        let month = today.toLocaleString('default', {month : 'long'});
        let year = today.getFullYear();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();

        m = checkTime(m);
        s = checkTime(s);
        
        $('#clock').text(`${day} ${month} ${year} ${h} : ${m} : ${s}`);
      
        let t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) i = "0" + i;
      
        return i;
    }

    //FLATPICKR
    $(".calendar").flatpickr({
        altInput: false,
        dateFormat: "Y-m-d",
        enableTime: false,
        minDate: new Date(),
        nextArrow: '<span class="text-white"><i class="fas fa-long-arrow-alt-right"></i></span>',
        prevArrow: '<span class="text-white"><i class="fas fa-long-arrow-alt-left"></i></span>',
        theme: 'material_red',
    });

    $(".search-calendar").flatpickr({
        altInput: false,
        dateFormat: "Y-m-d",
        enableTime: false,
        nextArrow: '<span class="text-white"><i class="fas fa-long-arrow-alt-right"></i></span>',
        prevArrow: '<span class="text-white"><i class="fas fa-long-arrow-alt-left"></i></span>',
        theme: 'material_red',
    });

    //FORM
    $('.dropdown-input').click(function() {
        $(this).attr('tabindex', 1).focus();

        $(this).toggleClass('active');

        $(this).find('.dropdown-menu').slideToggle(300);
    });

    $('.dropdown-input').focusout(function() {
        $(this).removeClass('active');

        $(this).find('.dropdown-menu').slideUp(300);
    });

    $('.dropdown-input .dropdown-menu li').click(function() {
        $(this).parents('.dropdown-input').find('span').text($(this).text());

        $(this).parents('.dropdown-input').find('input').attr('value', $(this).attr('id'));

        $(this).find("input[type='hidden']").val($(this).attr('id'));
    });

    $(function() {
        $('.input-text').focusin(function() {
            $(this).parent().addClass('focused');
        }); 

        $('.input-text').focusout(function() {
            $(this).parent().removeClass('focused');
        }); 
 
        $('.input-text').blur(function() {
            let curr_length = $(this).val().length;

            if (curr_length < 1) {
                $(this).parent().addClass('empty').removeClass('not-empty');
            } else {
                $(this).parent().addClass('not-empty').removeClass('empty');
            }
        });
    });

    //FULLSCREEN
    function toggleFullScreen(elem) {
        if((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
            if (elem.requestFullScreen) {
                elem.requestFullScreen();
            } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullScreen) {
                elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        } 
        else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } 
            else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } 
            else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } 
            else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    }

    //MONEY FORMAT
    function moneyFormat(number) {
        let number_string = number.toString();

        let remainder = number_string.length % 3;

        let rupiah = number_string.substr(0, remainder);

        let thousand = number_string.substr(remainder).match(/\d{3}/g);
            
        if (thousand) {
            separator = remainder ? '.' : '';

            rupiah += separator + thousand.join('.');
        }

        return 'Rp ' + rupiah;
    }
    
    //MODAL
    $('.modal-dropdown').click(function() {
        $(this).attr('tabindex', 1).focus();

        $(this).toggleClass('active');

        $(this).find('.dropdown-menu').slideToggle(300);
    });

    $('.modal-dropdown').focusout(function() {
        $(this).removeClass('active');

        $(this).find('.dropdown-menu').slideUp(300);
    });

    $('.modal-dropdown .dropdown-menu li').click(function() {
        $(this).parents('.modal-dropdown').find('span').text($(this).text());

        $(this).parents('.modal-dropdown').find('input').attr('value', $(this).attr('id'));
    });

    //NANOBAR
    $(document).ready(function() {
        let options = {
            classname: 'loading-page-bar',
            id: 'loadBar'
        };

        let nanobar = new Nanobar(options);
        
        nanobar.go(100);
    });

    //PWSTABS
    $(function() {
        $('.btn-cash').on('click', function() {
            $('.pay-tabs').pwstabs({
                theme: 'pws_theme_orange',
            });

            $('.pay-tabs').pwstabs('defaultTab', 1);
        });

        $('.btn-credit').on('click', function() {
            $('.pay-tabs').pwstabs({
                defaultTab: 2,
                theme: 'pws_theme_orange',
            });

            $('.pay-tabs').pwstabs('defaultTab', 2);
        });
    });

    @if(Request::segment(2) != 'purchasement' && Request::segment(3) != 'create')
        //RESET DATA
        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');

            $('input').removeClass('is-invalid');

            $('.select, .custom-select').removeClass('is-invalid'); 

            if(!$('.text-danger').hasClass('dropdown-item')) {
                $('.text-danger').html('');
            }
            
            $('#percent-disc-amount, #fix-disc-amount').removeClass('active');

            $('input[type=radio]').prop('checked', false);
        });

        $('#addModal').on('hidden.bs.modal', function() {
            $(this).find('input').val('');
        });

    @endif

    //SELECT2
    $(function() {
        $('.select2').select2();
        
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });

	//SIDEBAR
	let url = window.location;

    let uri =  url.pathname.split('/');

    if(uri[2] == 'pos') {
        $('a.nav-link').on('click', function() {
            if($(this).data('widget')) {
                $('aside.main-sidebar').toggle();   
            }
        });
    }
    
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    
    //TOASTR
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if(Session::has('failed'))

        toastr.error("{{ Session::get('failed') }}");
        
    @endif

    @if(Session::has('success'))

        toastr.success("{{ Session::get('success') }}");

    @endif
    
    //UPLOAD
    let btnUpload = $("#upload_file");
    let btnOuter = $(".button_outer");

    btnUpload.on("change", function(e) {
        let ext = btnUpload.val().split('.').pop().toLowerCase();

        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(".error_msg").text("File bukan gambar...");
        } 
        else {
            $(".error_msg").text("");

            btnOuter.addClass("file_uploading");

            let uploadedFile = URL.createObjectURL(e.target.files[0])

            setTimeout(function() {
                $("#uploaded_view").append('<img src="'+ uploadedFile +'" />').addClass("show");
            }, 1500);
        }
    });

    $(".file_remove").on("click", function(e) {
        $("#uploaded_view").removeClass("show");

        $("#uploaded_view").find("img").remove();

        btnOuter.removeClass("file_uploading");
        btnOuter.removeClass("file_uploaded");
    });

</script>