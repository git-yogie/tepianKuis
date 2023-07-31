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

        .container-custom {
            width: 50%;
            margin-top: 20px
        }

        @media(max-width: 768px){
            .container-custom{
                width: 100%
            }
        }
    </style>
    @include('template.main-page.components.svg_file')
</head>

<body class="bt-quiz">
    <div class="container-custom container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="{{ asset('images/quiz-picture.png') }}" style="width:100%; height:100%;"
                            class="card-img rounded-4 d-lg-block d-none" alt="" srcset="">
                    </div>
                    <div class="col-lg-9">
                        <h3>Kuis Perangkat Lunak</h3>
                        <p class="text-muted mb-0" style="font-size: 12px"><i class="fa-solid fa-graduation-cap"></i>
                            Informatika &bull; <i class="fa-solid fa-users"></i> 20 Peserta &bull; <i
                                class="fa-solid fa-clipboard-list"></i> 16 Soal
                        </p>
                        <span class="d-inline mt-0" style="font-size: 12px"><i class="fa-regular fa-id-card d-inline"></i> <p class="d-inline"> Yogie Prayoga</p> &bull; <i class="fa-solid fa-at"></i> yogie.prayoga35@gmail.com</span>
                        <span style="font-size: 12px " class="d-block" ><i class="fa-solid fa-hashtag"></i> NISN : 1782873</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="card mb-2">
                {{-- <div class="card-header d-flex justify-content-between align-items-baseline">
                    <h6>1. Pilihan Ganda &bull; 10 Poin</h6>
                </div> --}}
                <div class="card-body">
                    <p>Planet mana yang lebih dekat dengan matahari?</p>
                    <div id="jawaban" class="row mx-2">
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <p>Earth atau Bumi</p>
                        </div>
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <p>Mars</p>
                            </label>
                        </div>
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" disabled checked for="flexRadioDefault2">
                                <p>venus</p>
                            </label>
                        </div>
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <p>merkurius</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                {{-- <div class="card-header d-flex justify-content-between align-items-baseline">
                    <h6>2. Isian Matematis &bull; 10 Poin</h6>
                </div> --}}

                <div class="card-body">
                    <p> Dalam sebuah kelas terdapat 25 siswa. jika kita ingin menentukan berapa banyak pasangan siswa
                        yang dapat berjabat tangan satu sama lain secara bersamaan, dapat menggunakan rumus kombinasi
                        (\(C(n, k)\))
                        \[C(n, k) = \frac@{{ n! }}@{{ k!\cdot(n - k) ! }}\] dimana \(n\) adalah jumlah objek
                        yang dapat dipilih dan \(k\) adalah jumlah objek yang dipilih. Berapa banyak pasangan siswa yang
                        dapat berjabat tangan ?
                    </p>
                    <div id="jawaban" class="row mx-2">
                        <p>Jawaban </p>
                        <input type="number" placeholder="Jawab disini" value="300" class="form-controll">
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                {{-- <div class="card-header d-flex justify-content-between align-items-baseline">
                    <h6>3. Pilihan Ganda &bull; 10 Poin</h6>
                </div> --}}
                <div class="card-body">
                    <p>Ketika bumi dipenuhi oleh mahluk hidup bersel 1, apa yang terjadi?</p>
                    <div id="jawaban" class="row mx-2">
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <p>Bumi tidak cukup besar untuk menampung makhluk tersebut</p>
                        </div>
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <p>Bumi akan meledak</p>
                            </label>
                        </div>
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <p>mahluk ber sel 1 mengonsumsi karbon dioksida dan mengeluarkan oksigen sebagai poopnya
                                    yang menjadikan bumi lebih sejuk dan berhenti memerah</p>
                            </label>
                        </div>
                        <div class="col-md-auto form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <p>kemunculan predator sebagai pemangsa untuk menyetabilkan pertumbuhan makhluk ber sel
                                    tunggal yang semakin meningkat</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center mb-5">
                <button class="btn btn-secondary  me-2">Reset</button>
                <button class="btn btn-primary">Submi Jawaban</button>
            </div>
        </div>
    </div>


    {{-- includ modal here --}}

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
    {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}

    <script src="{{ asset('assets/js/quiz.js') }}"></script>


</body>

</html>
