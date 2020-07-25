<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SJ POS</title>  

        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

        <!-- CSS Checkbox -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/CSS-checkbox/dist/css/checkboxes.min.css') }}">   

        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

        <!-- Daterangepicker -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/daterangepicker/daterangepicker.css') }}">

        <!-- Flatpickr -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_red.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- ICheck -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

        <!-- IonIcons -->
        <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>

        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/jqvmap/jqvmap.min.css') }}">

        <!-- OverlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        <!-- Pwstabs -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/pwstabs/jquery.pwstabs.css') }}">

        <!-- Summernote -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/summernote/summernote-bs4.css') }}">

        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/adminlte.min.css') }}">
        
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/toastr/toastr.min.css') }}">

        <!-- Custom Style-->
        <link rel="stylesheet" href="{{ asset('public/adminlte/assets/css/style.css') }}">

        <link rel="stylesheet" href="{{ asset('public/adminlte/assets/css/button.css') }}">
        
        <link rel="stylesheet" href="{{ asset('public/adminlte/assets/css/form.css') }}">
        
        <link rel="stylesheet" href="{{ asset('public/adminlte/assets/css/pos.css') }}">

        @if(Request::segment(1) == 'pos')

            <style>

                aside.main-sidebar {
                    z-index: 9999;
                    display: none;
                }

            </style>

        @endif 

    </head>

        @yield('content')

        <div class="nanobar loading-page-bar" id="loadBar" style="position: fixed;">

            <div class="bar"></div>

        </div>

        <!-- jQuery -->
        <script src="{{ asset('public/adminlte/plugins/jquery/jquery.min.js') }}"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('public/adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        
            $.widget.bridge('uibutton', $.ui.button)
        
        </script>
        
        <!-- Bootstrap 4 -->
        <script src="{{ asset('public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('public/adminlte/dist/js/adminlte.js') }}"></script>
    
        <!-- ChartJS -->
        <script src="{{ asset('public/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        
        <!-- DataTables -->
        <script src="{{ asset('public/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('public/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Daterangepicker -->
        <script src="{{ asset('public/adminlte/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('public/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>

        <!-- Flatpickr -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- jQuery Knob Chart -->
        <script src="{{ asset('public/adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        
        <!-- JQVMap -->
        <script src="{{ asset('public/adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('public/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        
        <!-- NanoBar -->
        <script src="{{ asset('public/adminlte/plugins/nanobar/nanobar.min.js') }}"></script>

        <!-- OverlayScrollbars -->
        <script src="{{ asset('public/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        <!-- Payform -->
        <script src="{{ asset('public/adminlte/plugins/payform/jquery.payform.min.js') }}"></script>

        <!-- Pwstabs -->
        <script src="{{ asset('public/adminlte/plugins/pwstabs/jquery.pwstabs.min.js') }}"></script>

        <!-- Sparkline -->  
        <script src="{{ asset('public/adminlte/plugins/sparklines/sparkline.js') }}"></script>

        <!-- Summernote -->
        <script src="{{ asset('public/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>

        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('public/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

        <!-- Toastr -->
        <script src="{{ asset('public/adminlte/plugins/toastr/toastr.min.js') }}"></script>
        
        <!-- TypeAhead -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    
        <!-- Custom Script -->
        @include('layouts/scripts/script')

        @yield('script')

    </body>

</html>
