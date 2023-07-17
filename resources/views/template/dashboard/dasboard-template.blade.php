<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title") - TepianKuis></title>

    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('mazer') }}/css/shared/iconly.css">
    {{-- custom css --}}

    @yield("css")

    {{-- custom css end --}}
</head>

<body>
    <div id="app">
{{-- include sidebar --}}
        @include("template.dashboard.components.sidebar")
{{-- include Sidebar --}}
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield("page-heading")</h3>
            </div>
            <div class="page-content">
               @yield("main")
            </div>

           @include("template.dashboard.components.footer")
        </div>
    </div>
    <script src="{{ asset('mazer') }}/js/bootstrap.js"></script>
    <script src="{{ asset('mazer') }}/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('mazer') }}/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/dashboard.js"></script>

    {{-- custom js --}}
    @yield("js")

</body>

</html>
