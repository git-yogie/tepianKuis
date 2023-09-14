<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded-5">
                    <div class="card-body p-5">

                        <div class="row">
                            <div class="col-md-6">
                                <img class="img-fluid" width="50%" src="{{ asset('images/tepianLogo.png') }}"
                                    alt="">
                                <img class="img-fluid" src="{{ asset('images/login_image.png') }}" alt="">
                            </div>
                            <div class="col-md-6">

                                <h4 class="card-title">Mulai Ujian</h4>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>Info</strong> kode kuis didapatkan dari platform atau guru anda!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @if(session("error"))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Kesalahan!</strong> {{ session("error") }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action="{{ route('cbt.auth') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nis" class="form-label">NIS</label>
                                        <input type="text" class="form-control" id="nis" name="nis"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kode-kuis" class="form-label">Kode Kuis</label>
                                        <input type="text" class="form-control" id="kode-kuis" name="kode-kuis"
                                            required>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary d-block">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS (wajib karena Bootstrap 5 menggunakan JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/quizEngine/quizAuthCBT.js') }}"></script>
</body>

</html>
