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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"  >
    <!--end::Layout Skins -->
</head>

<body>
    <!-- include JQuery -->
   
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

            <script src="/js/vendor.js"></script>
            <script src="js/app.js"></script>
            <script src ="/js/master.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js "></script>  
    

    <!-- include Chart (https://www.chartjs.org/) -->
    <script src="./js/chart.min.js"></script>
    <div class="main-wrapper">
        <div class="app" id="app">
            <!-- begin:: Header Menu -->
            <header class="header">
                <div class="header-block header-block-nav">
                    <ul class="nav-profile">
                        <li class="notifications new">
                            <a href="{!! route('user.change-language', ['en']) !!}"><img src="./images/en.png" style="width: 32px;"></a>
                        </li>
                        <li style="padding-right: 5px;">
                            <a href="{!! route('user.change-language', ['vi']) !!}"><img src="./images/vi.png" style="width: 32px;"></a>
                        </li>
                        <li style="padding-right: 5px;">
                        <a class="dropdown-item" href="#"
                                       >
                                       {{ Auth::user()->name }}
                                    </a>

                                   
                        </li>
                        <li style="padding-right: 5px;">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>
                        
                        
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
                            </div> {{__('Booklibary')}}
                        </div>
                    </div>
                    <nav class="menu">
                        <ul class="sidebar-menu metismenu" id="sidebar-menu">
                            <li>
                                <a href="/Book">
                                    <i class="fa fa-home"></i> {{__('Book')}}
                                </a>
                            </li>
                            <li>
                                <a href="/Card">
                                    <i class="fa fa-users"></i> {{__('Card')}}
                                </a>
                            </li>
                            
                            <li>
                                <a href="/Student">
                                    <i class="fa fa-exchange"></i> {{__('Student')}}
                                </a>
                            </li>
                            <li>
                                <a href="/BorrowList">
                                    <i class="fa fa-address-card"></i> {{__('Borrow')}}
                                </a>
                            </li>
                            <li>
                                <a href="/LostList">
                                    <i class="fa fa-address-card"></i> {{__('Lost')}}
                                </a>
                            </li>
                            <li>
                                <a href="/Genre">
                                    <i class="fa fa-address-card"></i> {{__('Genre')}}
                                </a>
                            </li>
                            <li>
                                <a href="/User">
                                    <i class="fa fa-address-card"></i> {{__('User')}}
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