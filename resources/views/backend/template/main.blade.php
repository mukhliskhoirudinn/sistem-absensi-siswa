<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Panel - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    {{-- <link rel="icon" href="{{ asset('backend') }}/assets/img/kaiadmin/favicon.ico" type="image/x-icon" /> --}}

    <!-- Fonts and icons -->
    <script src="{{ asset('backend') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('backend') }}/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('backend.template.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="white">
                        <a href="{{ route('dashboard') }}" class="logo">
                            <img src="{{ asset('backend') }}/assets/img/kaiadmin/logo_light.svg" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar -->
                @include('backend.template.navbar')
                <!-- End Navbar -->
            </div>

            {{-- Main Content --}}
            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="copyright">
                        &copy; 2024 | <strong>Project SIB Kelompok 4.</strong> All rights reserved.
                    </div>
                </div>
            </footer>
        </div>

        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('backend') }}/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('backend') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="{{ asset('backend') }}/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('backend') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('backend') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('backend') }}/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('backend') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('backend') }}/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('backend') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('backend') }}/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('backend') }}/assets/js/setting-demo.js"></script>
    <script src="{{ asset('backend') }}/assets/js/demo.js"></script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });

        //pieChart dan multipleBarChart
        var pieChart = document.getElementById("pieChart").getContext("2d");
        var multipleBarChart = document.getElementById("multipleBarChart").getContext("2d");

        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [{
                    data: [50, 20, 18, 12],
                    backgroundColor: ["#1d7af3", '#28a745', "#fdaf4b", "#f3545d"],
                    borderWidth: 0,
                }, ],
                labels: ["Total Siswa", "Total Guru", "Total Cuti/Sakit/Izin", "Total Alfa"],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                pieceLabel: {
                    render: "percentage",
                    fontColor: "white",
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });

        var myMultipleBarChart = new Chart(multipleBarChart, {
            type: "bar",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                datasets: [{
                        label: "Total Siswa",
                        backgroundColor: "#1d7af3",
                        borderColor: "#1d7af3",
                        data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
                    },
                    {
                        label: "Total Guru",
                        backgroundColor: "#28a745",
                        borderColor: "#28a745",
                        data: [
                            145, 256, 244, 233, 210, 279, 287, 253, 287, 299, 312, 356,
                        ],
                    },
                    {
                        label: "Total Cuti/Sakit/Izin",
                        backgroundColor: "#fdaf4b",
                        borderColor: "#fdaf4b",
                        data: [
                            185, 279, 273, 287, 234, 312, 322, 286, 301, 320, 346, 399,
                        ],
                    },
                    {
                        label: "Total Alfa",
                        backgroundColor: "#f3545d",
                        borderColor: "#f3545d",
                        data: [
                            185, 279, 273, 287, 234, 312, 322, 286, 301, 320, 346, 399,
                        ],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                },
                title: {
                    display: true,
                    text: "Traffic Stats",
                },
                tooltips: {
                    mode: "index",
                    intersect: false,
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }, ],
                    yAxes: [{
                        stacked: true,
                    }, ],
                },
            },
        });
    </script>
</body>

</html>
