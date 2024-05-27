<!DOCTYPE html>
<html lang="en" dir="ltr"  style="--primary-rgb: 14, 107, 230;" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="RH Management application">
    <meta name="Author" content="Dev.Gaston Delimond">
    <meta name="keywords" content="IT Developer, Freelance developer, ">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TITLE -->
    <title> Gestion RH | {{$title}} </title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{asset('assets/icon-fonts/icons.css')}}" rel="stylesheet">

    <!-- APP SCSS -->
    <link rel="preload" as="style" href="{{asset('assets/css/app.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" />

    <!-- NODE WAVES CSS -->
    <link href="{{asset('assets/libs/node-waves/waves.min.css')}}" rel="stylesheet">

    <!-- SIMPLEBAR CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}">

    <!-- COLOR PICKER CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/%40simonwep/pickr/themes/nano.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css"')}}">

    <!-- CHOICES CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/choices.js/public/assets/styles/choices.min.css')}}">


    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css')}}">
    <!-- STYLES SECTIONS -->
    @yield('styles')
    <!-- STYLES SECTIONS -->

    <!-- CHOICES JS -->
    <script src="{{asset('assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
    <!-- MAIN JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

</head>

<body>


<!-- LOADER -->
<div id="loader">
    <img src="{{asset('assets/images/media/loader.svg')}}" alt="">
</div>
<!-- END LOADER -->

<!-- PAGE -->
<div class="page">

    <!-- HEADER -->
    @include('components.header')
    <!-- END HEADER -->

    <!-- SIDEBAR -->
    @include('components.sidebar')
    <!-- END SIDEBAR -->

    <!-- MAIN-CONTENT -->

    <div class="main-content app-content">

        @yield('content')

    </div>
    <!-- END MAIN-CONTENT -->

    <!-- SEARCH-MODAL -->

    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="input-group">
                        <a href="javascript:void(0);" class="input-group-text" id="Search-Grid"><i class="fe fe-search header-link-icon fs-18"></i></a>
                        <input type="search" class="form-control border-0 px-2" placeholder="Search" aria-label="Username">
                        <a href="javascript:void(0);" class="input-group-text" id="voice-search"><i class="fe fe-mic header-link-icon"></i></a>
                        <a href="javascript:void(0);" class="btn btn-light btn-icon" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <p class="font-weight-semibold text-muted mb-2">Are You Looking For...</p>
                        <span class="search-tags"><i class="fe fe-user me-2"></i>People<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                        <span class="search-tags"><i class="fe fe-file-text me-2"></i>Pages<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                        <span class="search-tags"><i class="fe fe-align-left me-2"></i>Articles<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                        <span class="search-tags"><i class="fe fe-server me-2"></i>Tags<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                    </div>
                    <div class="my-4">
                        <p class="font-weight-semibold text-muted mb-2">Recent Search :</p>
                        <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                            <a href="notifications.html"><span>Notifications</span></a>
                            <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                        </div>
                        <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                            <a href="alerts.html"><span>Alerts</span></a>
                            <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                        </div>
                        <div class="p-2 border br-5 d-flex align-items-center text-muted mb-0 alert">
                            <a href="mail.html"><span>Mail</span></a>
                            <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group ms-auto">
                        <button class="btn btn-sm btn-primary-light">Search</button>
                        <button class="btn btn-sm btn-primary">Clear Recents</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SEARCH-MODAL -->

    <!-- FOOTER -->
    @include('components.footer')
    <!-- END FOOTER -->

</div>
<!-- END PAGE-->

<!-- SCRIPTS -->

<!-- SCROLL-TO-TOP -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
</div>
<div id="responsive-overlay"></div>

<!-- POPPER JS -->
<script src="{{asset('assets/libs/%40popperjs/core/umd/popper.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- NODE WAVES JS -->
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

<!-- SIMPLEBAR JS -->
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

<script src="{{asset('assets/js/pages/simplebar-init.js')}}"></script>

<!-- COLOR PICKER JS -->
<script src="{{asset('assets/libs/%40simonwep/pickr/pickr.es5.min.js')}}"></script>

<!-- JSVECTOR MAPS JS -->
<script src="{{asset('assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>

<script src="{{asset('assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

<!-- APEX CHARTS JS -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- CHARTJS CHART JS -->
<script src="{{asset('assets/libs/chart.js/chart.min.js')}}"></script>


<!-- SWEETALERT JS -->
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>


<!-- CRM-Dashboard -->
<script src="{{asset('assets/js/pages/crm-dashboard-init.js')}}"></script>


<!-- STICKY JS -->
<script src="{{asset('assets/js/sticky.js')}}"></script>

<!-- APP JS -->
<script src={{asset('assets/js/app.js')}}></script>

<!-- BS SCRIPTS JS -->
<script src={{asset('assets/js/app/bs_scripts_init.js')}}></script>

<!-- BS EDITION JS -->
<script src={{asset('assets/js/app/edition.js')}}></script>





<!-- CUSTOM-SWITCHER JS -->
<script type="module" src="{{asset('assets/js/custom-switcher.js')}}"></script>




@yield('scripts')

<!-- END SCRIPTS -->

</body>

</html>
