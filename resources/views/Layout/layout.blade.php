<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        {{ $title }}
    </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="/assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="/">
                    <b class="logo-abbr"><img src="/assets/images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="/assets/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="/assets/images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <!-- <div class="header">    
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
            </div>
        </div> -->
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="/" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Pendidikan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/perkuliahan">Perkuliahan</a></li>
                            <li><a href="/Seminar">seminar</a></li>
                            <li><a href="/KKN">kkn</a></li>
                            <li><a href="/bimbingan">bimbingan</a></li>
                            <li><a href="/penguji">penguji</a></li>
                            <li><a href="/pembina">pembina</a></li>
                            <li><a href="/pengembang_progkul">pengembang program kuliah</a></li>
                            <li><a href="/pengembang_pengajaran">pengembang pengajaran</a></li>
                            <li><a href="/orasi">orasi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        @yield('content')


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="#">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/assets/plugins/common/common.min.js"></script>
    <script src="/assets/js/custom.min.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/gleek.js"></script>
    <script src="/assets/js/styleSwitcher.js"></script>

    <script src="/assets/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    @if (session('success'))
    <script>
        var SweetAlert2Demo = function() {
            var initDemos = function() {
                swal({
                    title: "{{ session('success') }}",
                    Text: "{{ session('success') }}",
                    icon: "success",
                    buttons: {
                        confirm: {
                            Text: "Confirm Me",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModel: true
                        }
                    }
                });
            };

            return {
                init: function() {
                    initDemos();
                }
            };
        }();

        jQuery(document).ready(function() {
            SwwetAlert2Demo.init();
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        var SweetAlert2Demo = function() {
            var initDemos = function() {
                swal({
                    title: "{{ session('error') }}",
                    Text: "{{ session('error') }}",
                    icon: "error",
                    buttons: {
                        confirm: {
                            Text: "Confirm Me",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModel: true
                        }
                    }
                });
            };

            return {
                init: function() {
                    initDemos();
                }
            };
        }();

        jQuery(document).ready(function() {
            SwwetAlert2Demo.init();
        });
    </script>
    @endif

</body>

</html>