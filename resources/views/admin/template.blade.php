<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tepian Dashboard - @yield("title")</title>

    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    @yield("css")
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ route("admin.dashboard") }}"><img src="{{ asset('images/tepianLogo.png') }}"
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
                                        <h6 class="user-dropdown-name">{{ Auth::guard('admin')->User()->nama }}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Dewa</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                    aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="{{ route("admin.logout") }}">Logout</a></li>
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
                                <a href="{{ route("admin.dashboard") }}" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item  ">
                                <a href="{{ route("admin.user") }}" class='menu-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>User</span>
                                </a>
                            </li>
                            <li class="menu-item  ">
                                <a href="{{ route("admin.log") }}" class='menu-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Log - Aplikasi</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">
                @yield("main-content")


            </div>

        </div>
    </div>
    <script src="{{ asset('mazer') }}/js/bootstrap.js"></script>
    <script src="{{ asset('mazer') }}/js/app.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/horizontal-layout.js"></script>

    <script src="{{ asset('mazer') }}/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/dashboard.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @yield("js")

</body>

</html>
