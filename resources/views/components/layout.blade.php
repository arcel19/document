<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin</title>
    <link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="assets/node_modules/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    {{-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar navbar-default col-lg-12 col-12 fixed-top d-flex flex-row p-0">
            <div class="navbar-brand-wrapper bg-white text-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo_star_black.png" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo_star_mini.jpg"
                        alt=""></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3"
                    type="button" data-toggle="minimize">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form class="form-inline mt-md-0 d-none d-lg-block mt-2">
                    <input class="form-control mr-sm-2 search" type="text" placeholder="Search">
                </form>
                <ul class="navbar-nav ml-lg-auto d-flex align-items-center flex-row">
                    <li class="nav-item">
                        <a class="nav-link profile-pic" href="#"><img class="rounded-circle"
                                src="{{ \App\Models\User::find(auth()->user()->id)->profile_photo_url }}"
                                alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-th"></i></a>
                    </li>
                </ul>
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" x-data>

                    @csrf

                    <button class="btn btn-outline-danger" type="submit">
                        {{ __('Log Out') }}</button>
                    <button class="navbar-toggler navbar-dark navbar-toggler-right d-lg-none align-self-center"
                        type="submit" data-toggle="offcanvas"> {{ __('Log Out') }}
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </form>

            </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid">
            @if (session()->has('message'))
            <div class="alert alert-warning alert-dismissable" role="alert">
                {{ session('message') }}
            </div>
        @endif

            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas bg-white" id="sidebar">
                <div class="user-info">
                    <img src="{{ \App\Models\User::find(auth()->user()->id)->profile_photo_url }}" alt="">
                    <p class="name font-bold">{{ auth()->user()->name }}</p>
                    <p class="designation font-bold"> Role: {{ auth()->user()->user_type }}</p>
                    <span class="online"></span>
                </div>
                <ul class="nav">
                    <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <img src="assets/images/icons/1.png" alt="">
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user()->user_type == 'Admin')
                        <li class="nav-item {{ Request::routeIs('user.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <img src="assets/images/icons/1.png" alt="">
                                <span class="menu-title">users</span>
                            </a>
                        </li>
                    @endif


                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" data-target="#sample-pages" href="#sample-pages"
                            aria-expanded="true" aria-controls="sample-pages">
                            <img src="assets/images/icons/9.png" alt="">
                            <span class="menu-title">Documents<i class="fa fa-sort-down"></i></span>
                        </a>

                    </li>
                    <li class="nav-item {{ Request::routeIs('inbound') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('inbound') }}">
                            <img src="assets/images/icons/1.png" alt="">
                            <span class="menu-title">Inbound</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('outbound') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('outbound') }}">
                            <img src="assets/images/icons/1.png" alt="">
                            <span class="menu-title">Outbound</span>
                        </a>
                    </li>
                    @if (auth()->user()->user_type == 'Admin')
                    <li class="nav-item {{ Request::routeIs('logIndex') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('logIndex') }}">
                            <img src="assets/images/icons/1.png" alt="">
                            <span class="menu-title">Log History</span>
                        </a>
                    </li>
                    @endif

                    {{-- <li class="collapsed font-weight-bold">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#">
                            <i class="icofont-notepad fs-5" style="color: #c3b10f;"></i> <span>Documents</span> <span
                                class="arrow icofont-rounded-down ms-auto fs-5 text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-order">
                            <li><a class="ms-link {{ Request::routeIs('outbound') ? 'active' : ' ' }}"
                                    href="{{ route('outbound') }}"><i class="fa-solid fa-angle-right"
                                        style="color: #c3b10f;"></i><span class="ms-2">Outbound</span></a></li>
                            <li><a class="ms-link {{ Request::routeIs('inbound') ? 'active' : ' ' }}"
                                    href="{{ route('inbound') }}"><i class="fa-solid fa-angle-right"
                                        style="color: #c3b10f;"></i><span class="ms-2">Inbound</span></a></li>
                        </ul>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="assets/images/icons/10.png" alt="">
                            <span class="menu-title">Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


        <main>

            {{ $slot }}

        </main>



        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="float-right">
                    <a href="#">Star Admin</a> &copy; 2017
                </span>
            </div>
        </footer>

        <!-- partial -->


    </div>

    {{-- <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script> --}}
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/maps.js"></script>
    <script src="assets/js/bootstrap.js"></script>


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
</body>

</html>
