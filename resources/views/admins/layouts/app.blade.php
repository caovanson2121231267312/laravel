<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @yield('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta name="copyright" content="Copyright © 2024 {{ config('app.name') }}">
    <meta name="Author" content="{{ config('app.name') }}">
    <meta content="Global" name="distribution">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{-- <link href="{{ asset('assets/libs/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet" > --}}

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('admins.layouts.header')

        @include('admins.layouts.siderbar')

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        @yield('breadcrumb')

                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">



                    @yield('body')



                </div>
            </section>

        </div>
    </div>

    @include('admins.layouts.footer')
    </div>


    @stack('scripts')

    {{-- <script>
        $(document).ready(function() {
            $('.select2').select2()

            $('#langs').on('change', function() {
                var selectedLang = $(this).val();
                $.ajax({
                    url: '{{ route('lang') }}',
                    type: 'POST',
                    data: {
                        lang: selectedLang
                    },
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    success: function(response) {
                        toastr.success(response?.success)
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                        // console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // console.error(xhr.responseText);
                        toastr.error(xhr.responseText)
                    }
                });
            });
        });
    </script> --}}


</body>

</html>
