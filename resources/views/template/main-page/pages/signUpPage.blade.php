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
        <div id="toastContainer2" class="position-fixed bottom-0 end-0 p-3"></div>
        <form class="row" id="form-daftar">
            <img class="mb-4" src="{{ asset("images/tepianLogo.png") }}" style="width: 48%" alt="">
            <h1 class="h3 mb-3 fw-normal">Daftar Tepian Kuis</h1>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="namaDaftar" class="form-control" id="nama">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="emailDaftar" class="form-control" id="emailDaftar">
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

        </form>
    </main>

@endsection

@section('js')
    <script src="{{ asset("assets/js/signUp.js") }}"></script>
@endsection
