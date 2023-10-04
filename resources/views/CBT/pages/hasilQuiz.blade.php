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

        .card-width {
            width: 50rem;
        }

        @media (max-width: 768px) {
            .card-width {
                width: 25rem;
            }
        }

        /* Tablet */
        @media (min-width: 769px) and (max-width: 1024px) {
            .card-width {
                width: 35rem;
            }
        }

        /* Desktop */
        @media (min-width: 1025px) {
            .card-width {
                width: 60rem;
            }
        }
    </style>
    @include('template.main-page.components.svg_file')
    @php
        $inputMilidetik = $parseResult->waktu_mengerjakan; // Contoh input dalam milidetik (620000 milidetik = 10 menit 20 detik)
        
        // Menghitung menit dan detik
        $menit = floor($inputMilidetik / 60000); // 1 menit = 60000 milidetik
        $sisaMilidetik = $inputMilidetik % 60000;
        $detik = $sisaMilidetik / 1000; // 1 detik = 1000 milidetik
        
        // Format hasil
        $waktuFormat = sprintf('%d menit %d detik', $menit, $detik);
        
        // dd($parseKonfigurasi);
        
        // Menampilkan waktu
        
    @endphp

</head>

<body>
    <div class="card m-auto mt-5 card-width">
        <div class="card-body">
            <div class="text-center">
                <h2>Hasil Kuis</h2>
                <h4>Kuis Perangkat Lunak</h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/exam.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1 class="text-center mt-3" style="font-size: 100px">{{ $parseResult->nilai }} </h1>
                    <h3 class="text-center">{{ session('peserta_kuis.nama') }}</h3>
                    <h4 class="text-center">{{ session('peserta_kuis.nis') }}</h4>
                    <table class="table">
                        <tr>
                            <td scope="row">Jumlah Poin</td>
                            <td>{{ $parseResult->poin . ' / ' . $parseResult->jumlahPoin }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Jawaban Benar</td>
                            <td>{{ $parseResult->jumlahBenar }} / {{ count($quiz->soal) }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Jawaban Salah</td>
                            <td>{{ count($parseResult->jawaban_user) - $parseResult->jumlahBenar }}/{{ count($quiz->soal) }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Waktu Mengerjakan</td>
                            <td>{{ $waktuFormat }}</td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-center">
                        @if (isset($parseKonfigurasi->ulangi))
                            @if ($parseKonfigurasi->ulangi)
                            <a class="btn me-3 btn-outline-primary" href="{{ route("cbt",$quiz->kuis_code) }}">Coba Lagi</a>
                            @endif
                        @endif
                        <a class="btn btn-outline-success" href="{{ route('cbt.unauth') }}">Selesai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/quizEngine/quizResult.js') }}"></script>
</body>

</html>
