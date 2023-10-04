<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' rel='stylesheet' />
    @yield('css')
    <style>
        .spanigen {
            transition: opacity 0.5 ease-in-out;
        }
    </style>
    @include('template.main-page.components.svg_file')
</head>

<body>
    @include('template.main-page.components.themeButton')
    @include('template.main-page.components.NavBar')

    @yield('main')
    <footer class="footer d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top container">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 yogieDesk,</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <a href="" class="btn btn-outline-secondary mx-1" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="git-yogie"><i class="fa-brands fa-github"></i></a>
            <a href="" class="btn btn-outline-secondary mx-1" data-bs-toggle="tooltip"
                data-bs-title="@yogie_desk"><i class="fa-brands fa-instagram"></i></a>
            <a href="" class="btn btn-outline-secondary mx-1"><i class="fa-brands fa-linkedin-in"></i></a>
        </ul>
    </footer>

    {{-- includ modal here --}}
    @include('template.main-page.components.modal-masuk')

    {{-- here,s end --}}
   
    {{-- js Library --}}
    <script src="{{ asset('assets/module/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    {{-- fontawsome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- custom js --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/authentication.js') }}"></script>
    <script src="{{ asset("mazer/extensions/sweetalert2/sweetalert2.min.js") }}"></script>
    @yield('js')


</body>

</html>
