<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/auth.css">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer') }}/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <img src="{{ asset('images/tepianLogo.png') }}" alt="Logo" class="img-fluid" style="width: 40%">
                    <div class="auth-logo" style="">
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Halaman Login Pengelolaan Aplikasi Tepian Kuis</p>
                    @error("notAuthenticate")
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('admin.auth') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username"
                                class="form-control form-control-xl @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl  @error('username') is-invalid @enderror"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
