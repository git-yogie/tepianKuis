@extends('template.main-page.main-page')

@section('title', 'TepianKuis - Daftar')

@section('css')
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 50%;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;

        }

        @media(max-width: 425px) {
            .form-signin {
                max-width: 80%;
            }
        }

        @media(max-width:745px){
            .form-signin{
                max-width: 75@;
            }
        }
    </style>
@endsection

@section('main')

    <main class="form-signin w-100 m-auto container">
        <form class="row" id="form-daftar">
            <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="emailDaftar">
            </div>

            <div class="col-md-6">
                <label for="daftarPassword" class="form-label">Password</label>
                <input type="password" name="passwordDaftar" class="form-control" id="daftarPassword">
            </div>
            <div class="col-md-6">
                <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
                <input type="password" name="konfirmasiPassword" class="form-control" id="konfirmasiPassword">
            </div>

            <button class="btn btn-primary w-100 py-2 m-3" id="daftarButton" type="submit">Daftar</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017~2023</p>
        </form>
    </main>

@endsection

@section('js')
    <script src="{{ asset("assets/js/signUp.js") }}"></script>
@endsection
