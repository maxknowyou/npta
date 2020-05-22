<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Book Sale Manager </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Layout Skins-->
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <base href="{{ '//' . $_SERVER['HTTP_HOST'] }}">
    <!-- Place favicon.ico in the root directory -->
    <link type="text/css" href="/css/vendor.css" rel="stylesheet">
    <link type="text/css" id="theme-style" href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />  
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet" /> 
    <!--end::Layout Skins -->
</head>

<body>
    <!-- include JQuery -->
    <script src="/js/jquery-3.4.1.js"></script>
            <script src="/js/jquery-3.4.1.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            <script src="/js/vendor.js"></script>
            <script src="js/app.js"></script>
            <script src ="/js/master.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js "></script>  
    <!-- include Chart (https://www.chartjs.org/) -->
    <script src="./js/chart.min.js"></script>
    <div class="main-wrapper">
        <div class="app" id="app">
            <!-- begin:: Header Menu -->
            <header class="header">
                <div class="header-block header-block-nav">
                    <ul class="nav-profile">
                        <li class="notifications new">
                            <a href="{!! route('user.change-language', ['en']) !!}"><img src="./images/united-kingdom.svg" style="width: 32px;"></a>
                        </li>
                        <ul style="padding-right: 5px;">
                            <a href="{!! route('user.change-language', ['vi']) !!}"><img src="./images/vi.png" style="width: 32px;"></a>
                        </ul>
                        
                    </ul>
                </div>
            </header>
            <!-- end:: Header Menu -->
            <!-- begin:: Aside Menu -->
            <aside class="sidebar">
                <div class="sidebar-container">
                    <div class="sidebar-header">
                        <div class="brand">
                            <div class="logo">
                                <span class="l l1"></span>
                                <span class="l l2"></span>
                                <span class="l l3"></span>
                                <span class="l l4"></span>
                                <span class="l l5"></span>
                            </div> {{__('BOOKSALEMANAGER')}}
                        </div>
                    </div>
                    <nav class="menu">
                        <ul class="sidebar-menu metismenu" id="sidebar-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-home"></i> {{__('SYSTEMMANAGEMENT')}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-users"></i> {{__('MEMBERSHIPMANAGEMENT')}}
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-th-large"></i> {{__('LIBRARYMANAGEMENT')}} <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="#"> {{__('DIRECTORYMANAGEMENT')}} </a>
                                    </li>
                                    <li>
                                        <a href="#"> {{__('CATEGORIES')}} </a>
                                    </li>
                                    <li>
                                        <a href="#"> {{__('BOOKSMANAGEMENT')}} </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-exchange"></i> {{__('TRANSACTIONSMANAGEMENT')}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-address-card"></i> {{__('ACCOUNTMANAGEMENT')}}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- end:: Aside Menu -->
            <!-- begin:: Content -->
            @yield('content')
            <!-- end:: Content -->
            <!-- begin:: Footer -->
            <div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer" style="background-color: #d7dde4; height: 25px;">
                <div class="kt-container kt-container--fluid" style="text-align:center">
                    <div class="kt-footer__copyright">
                        2019&nbsp;&copy;&nbsp;Copyright<a href="https://bittosolution.vn" target="_blank" class="kt-link"> BitToSolution </a>
                    </div>
                </div>
            </div>
            <!-- end:: Footer -->
            <!-- Reference block for JS -->
            <div class="ref" id="ref">
                <div class="color-primary"></div>
                <div class="chart">
                    <div class="color-primary"></div>
                    <div class="color-secondary"></div>
                </div>
            </div>
</body>
</html>