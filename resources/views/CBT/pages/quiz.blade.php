<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CBT - FIle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' rel='stylesheet' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
    <style>
        .spanigen {
            transition: opacity 0.5 ease-in-out;
        }

        .bg-quiz {
            background-color: F2F7FF;
        }
    </style>
    @include('template.main-page.components.svg_file')
</head>

<body class="bt-quiz">
    <div class="container mt-4">
        <nav class="navbar sticky-top bg-body-tertiary shadow rounded-4">
            <div class="container-fluid rounded-4 px-4 d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#">Tepian Kuis</a>
                <div class="d-none d-lg-block">
                    <h4 id="nama_kuis"></h4>
                </div>
                <div class="">
                    <p class="text-muted mb-0">Sisa Waktu</p>
                    <p class="fw-bold" style="margin-top: 0" id="timerText">00 : 00 : 00</p>
                </div>
            </div>
        </nav>
        <div class="row mt-3">
            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5 id="nomerSoal">Nomor Soal 1</h3>
                            {{-- bisa menjadi sesutu dengan menggunakan sema yang mungkin bisa menjadi --}}
                    </div>
                    <div class="card-body">
                        <div id="soal-render">
                            <p> Dalam sebuah kelas terdapat 25 siswa. jika kita ingin menentukan berapa banyak pasangan
                                siswa
                                yang dapat berjabat tangan satu sama lain secara bersamaan, dapat menggunakan rumus
                                kombinasi
                                (\(C(n, k)\))
                                \[C(n, k) = \frac@{{ n! }}@{{ k!\cdot(n - k) ! }}\] dimana \(n\) adalah
                                jumlah
                                objek
                                yang dapat dipilih dan \(k\) adalah jumlah objek yang dipilih. Berapa banyak pasangan
                                siswa
                                yang
                                dapat berjabat tangan ?
                            </p>
                        </div>

                        <div id="jawaban" class="row mx-2">
                            <p>Jawaban </p>
                            <input type="number" placeholder="Jawab disini" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <button class="btn btn-primary mt-3 sebelumnya"><i
                                        class="fa-solid fa-chevron-left "></i> Sebelumnya
                                </button>
                                <button class="btn btn-primary mt-3 ms-auto selanjutnya">Selanjutnya <i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                            <div class="">
                                <button id="zoom-in" class="btn btn-sm btn-outline-primary mt-3"><i
                                        class="fa-solid fa-magnifying-glass-plus"></i></button>
                                <button id="zoom-out" class="btn btn-sm btn-outline-primary mt-3 ms-auto"><i
                                        class="fa-solid fa-magnifying-glass-minus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-sm-2">
                <div class="card mb-2 rounded-4">
                    <div class="row ">
                        <div class="col-4 d-flex justify-items-center align-items-center">
                            <img class="card-img  rounded-4 mx-2" style="width: 100px; height: 100px;"
                                src="{{ asset('mazer/images/faces/1.jpg') }}" />
                        </div>
                        <div class="col-8">
                            <div class="card-body d-flex flex-column align-items-center">
                                <p class="fw-bold  text-center mt-2">{{ session('peserta_kuis.nama') }}</p>
                                <p class=" fs-5 text-body-secondary text-center">{{ session('peserta_kuis.nis') }}</p>
                                <input type="hidden" name="" id="id_user"
                                    value="{{ session('peserta_kuis.id_peserta') }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card ">
                    <div class="card-body container p-auto">
                        <p class="fw-medium fs-5 text-center">No Soal</p>
                        <div class="row justify-content-start m-auto" id="no_soal">

                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-2">
                    <button class="btn btn-primary" id="selesai" type="button">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_waktuHabis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Waktu Habis!</h1>
                </div>
                <div class="modal-body">
                    Hasil Quiz anda akan disimpan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Lihat Hasil</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_selesai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Selesai?</h1>
                </div>
                <div class="modal-body">
                    Anda Yakin sudah selesai?, periksa kembali jawaban anda.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="konfirmasi_selesai"">Selesai</button>
                </div>
            </div>
        </div>
    </div>
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
    {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/quiz.js') }}"></script>
    <script src="{{ asset('assets/js/quizEngine/quizEngineCBT.js') }}"></script>
    <script src="{{ asset('assets/js/quizEngine/quizConfig.js') }}"></script>

</body>

</html>
