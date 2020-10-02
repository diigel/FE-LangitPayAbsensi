<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- <link rel="shortcut icon" href="{{ asset('img/favicon-96x96.png') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
</head>
<body class="hold-transition sidebar-mini">
<div id="app" class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <a class="nav-link" data-widget="control-sidebar" href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    {{ __('Logout ') }}<i
        class="fas fa-power-off"></i></a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light elevation-4">
<!-- Brand Logo -->
<a href="" class="brand-link">
    <img src="{{url('./image/logo_lp_absensi.png')}}" alt="Langitpay Logo" class="brand-image elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Langitpay Absensi</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{url('./image/user.png')}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
        @if (Auth::user()->role == '0')s
            <span class="badge badge-warning">Customer Service</span>
        @elseif(Auth::user()->role == '1')
            <span class="badge badge-success">Supervisor</span>
        @else
            <span class="badge badge-primary">HRD Langitpay</span>
        @endif
    </div>
    </div>

    <!-- Sidebar Menu -->
    <nav  av class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link active">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Home</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/register/add') }}" class="nav-link active">
                    <i class="nav-icon fas fa-registered"></i>
                    <p>Register Form</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/employe/index') }}" class="nav-link active">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Data Karyawan</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/presensi/index') }}" class="nav-link active">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>Data Absensi</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/verification/index') }}" class="nav-link active">
                    <i class="nav-icon fas fa-user-check"></i>
                    <p>Verifikasi</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                {{-- <a href="{{ url('/index/chart') }}" class="nav-link active">
                    <i class="nav-icon fas fa-file-export"></i>
                    <p>Report</p>
                </a> --}}
                
                <li class="nav-item">
                    <a class="nav-link active" data-widget="control-sidebar" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i
                    class="nav-icon fas fa-power-off"></i> {{ __('Logout ') }}</a>
                
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
            </div><!-- /.col -->
            {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
            </div><!-- /.col --> --}}
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<!-- Main content -->
@yield('container')
</div>

<!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020 <a href="https://langitpayment.com/">Langitpayment.com</a>.</strong> All rights reserved.
    </footer>
</div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script> --}}


    {{-- <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script> --}}
    <script>
        @if(count($errors) > 0)
            $(document).ready(function(){
                $('#editTransaksi').modal({show: true});
                $('#editMarketplace').modal({show: true});
            });
        @endif

        $(function () {
            $("#alltables").DataTable({
                "bPaginate": false,
                "bFilter": false
            });
        });
    </script>
{{-- @stack('scripts') --}}
{{-- @include('js/js') --}}
</body>
</html>
