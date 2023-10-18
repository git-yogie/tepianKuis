<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tepian Kuis</title>

    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('mazer') }}/css/shared/iconly.css">
    <style>
        .scaling {
            transform: scale(3);
            transition: all 0.5s;
        }

        @media screen and (max-width: 480px) {
            .scaling {
                transform: scale(3);
                transition: all 0.5s;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('images/tepianLogo.png') }}"
                                    class="img img-fluid scaling" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown"
                                    class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="{{ asset('mazer') }}/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">John Ducky</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Member</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                    aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="#">My Account</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="auth-login.html">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>User</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">

                <div class="page-heading">
                    <h3>Tepian Dashboard</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldShow"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Pengguna</h6>
                                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Kuis dibuat</h6>
                                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldAdd-User"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Api Access</h6>
                                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Peserta kuis</h6>
                                                    <h6 class="font-extrabold mb-0">112</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Profile Visit</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="chart-profile-visit"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Profile Visit</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <svg class="bi text-primary" width="32" height="32"
                                                            fill="blue" style="width:10px">
                                                            <use
                                                                xlink:href="{{ asset('mazer') }}/images/bootstrap-icons.svg#circle-fill" />
                                                        </svg>
                                                        <h5 class="mb-0 ms-3">Europe</h5>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-0">862</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div id="chart-europe"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <svg class="bi text-success" width="32" height="32"
                                                            fill="blue" style="width:10px">
                                                            <use
                                                                xlink:href="{{ asset('mazer') }}/images/bootstrap-icons.svg#circle-fill" />
                                                        </svg>
                                                        <h5 class="mb-0 ms-3">America</h5>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-0">375</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div id="chart-america"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <svg class="bi text-danger" width="32" height="32"
                                                            fill="blue" style="width:10px">
                                                            <use
                                                                xlink:href="{{ asset('mazer') }}/images/bootstrap-icons.svg#circle-fill" />
                                                        </svg>
                                                        <h5 class="mb-0 ms-3">Indonesia</h5>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-0">1025</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div id="chart-indonesia"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Latest Comments</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-lg">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Comment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-md">
                                                                        <img
                                                                            src="{{ asset('mazer') }}/images/faces/5.jpg">
                                                                    </div>
                                                                    <p class="font-bold ms-3 mb-0">Cantik</p>
                                                                </div>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0">Congratulations on your graduation!
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-md">
                                                                        <img
                                                                            src="{{ asset('mazer') }}/images/faces/2.jpg">
                                                                    </div>
                                                                    <p class="font-bold ms-3 mb-0">Ganteng</p>
                                                                </div>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0">Wow amazing design! Can you make
                                                                    another tutorial for
                                                                    this design?</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card">
                                <div class="card-body py-4 px-5">

                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset('mazer') }}/images/faces/1.jpg" alt="Face 1">
                                        </div>
                                        <div class="ms-3 name">
                                            <h5 class="font-bold">John Duck</h5>
                                            <h6 class="text-muted mb-0">@johnducky</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Recent Messages</h4>
                                </div>
                                <div class="card-content pb-4">
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="avatar avatar-lg">
                                            <img src="{{ asset('mazer') }}/images/faces/4.jpg">
                                        </div>
                                        <div class="name ms-4">
                                            <h5 class="mb-1">Hank Schrader</h5>
                                            <h6 class="text-muted mb-0">@johnducky</h6>
                                        </div>
                                    </div>
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="avatar avatar-lg">
                                            <img src="{{ asset('mazer') }}/images/faces/5.jpg">
                                        </div>
                                        <div class="name ms-4">
                                            <h5 class="mb-1">Dean Winchester</h5>
                                            <h6 class="text-muted mb-0">@imdean</h6>
                                        </div>
                                    </div>
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="avatar avatar-lg">
                                            <img src="{{ asset('mazer') }}/images/faces/1.jpg">
                                        </div>
                                        <div class="name ms-4">
                                            <h5 class="mb-1">John Dodol</h5>
                                            <h6 class="text-muted mb-0">@dodoljohn</h6>
                                        </div>
                                    </div>
                                    <div class="px-4">
                                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                                            Conversation</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Visitors Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-visitors-profile"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="https://saugi.me">Saugi</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('mazer') }}/js/bootstrap.js"></script>
    <script src="{{ asset('mazer') }}/js/app.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/horizontal-layout.js"></script>

    <script src="{{ asset('mazer') }}/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/dashboard.js"></script>

</body>

</html>
