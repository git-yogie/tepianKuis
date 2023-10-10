<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doc - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('mazer/extensions/toastify-js/src/toastify.css') }}">
    <script src="{{ asset('assets/module/ckeditor/ckeditor.js') }}"></script>
    @yield('css')
</head>

<body>
    <nav class="navbar container navbar-light d-flex justify-items-between ">
        <div class="">
            <a href="{{ route('dashboard') }}"><i class="bi bi-chevron-left"></i></a>
            <a href="{{ route('dashboard') }}" class="navbar-brand ms-4" onclick="">
                <img src="{{ asset('images/tepianLogo.svg') }}" style="transform: scale(2.5);">
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row">

        </div>
        @yield('main-content')
    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('mazer/extensions/toastify-js/src/toastify.js') }}"></script>


    @yield('js')

</body>

</html>
