<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url()->to('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($title) ? $title : '' }} - AZTLAN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/default.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="javascript:void(0);">
						<i class="fas fa-house-user"></i>
                        {{ !empty(company()->company_name) ?: null }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <logout-top-button-component url="{{ route('logout') }}"></logout-top-button-component>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('assets/img/logos/global.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-rounded elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">&nbsp;</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ current_user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-iline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                @include('partials.sidebar_menu')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @include('flash::message')
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ !empty($title) ? $title : 'Dashboard' }}</h1>
                        </div>
                        @if($breadcrumb)
                            @if(empty($param))
                                {!! Breadcrumbs::render($breadcrumb) !!}
                            @elseif(is_array($param))
                                {!! Breadcrumbs::render($breadcrumb, $param[0], $param[1], $param[1]) !!}
                            @else
                                {!! Breadcrumbs::render($breadcrumb, $param) !!}
                            @endif
                        @endif
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0-pre
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
</div>
<!-- ./wrapper -->


<script src="{{ asset('assets/js/bundle.js')  }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

@yield('scripts')

<script src="{{ asset('assets/js/default.min.js') }}"></script>


</body>
</html>
