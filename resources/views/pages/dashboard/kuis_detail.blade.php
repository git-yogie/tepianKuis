@extends('template.dashboard.dasboard-template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
@endsection

@section('page-heading', 'Kuis Perangkat Lunak')

@section('main')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{ asset('images/quiz-picture.png') }}" style="width:100px; height:100px;"
                                class="card-img rounded-4" alt="" srcset="">
                        </div>
                        <div class="col-md-9">
                            <h3>Kuis Perangkat Lunak</h3>
                            <p class="text-muteed" style="font-size: 12px"><i class="fa-solid fa-graduation-cap"></i>
                                Informatika &bull; <i class="fa-solid fa-users"></i> 20 Peserta &bull; <i
                                    class="fa-solid fa-clipboard-list"></i> 16 Soal
                            </p>
                            <span class="d-flex align-items-baseline"><i class="fa-solid fa-key me-3"></i><input
                                    style="width: 40%" class="form-control form-control-sm" type="text"
                                    placeholder="kode kuis" disabled aria-label=".form-control-sm example"> <button
                                    class="btn btn-outline-primary btn-sm ms-2"><i class="fa-solid fa-copy"></i></button>
                            </span>
                            <div class="d-flex mt-4">
                                {{-- ini adalah tombol dari kuis --}}
                                <button class="btn btn-outline-primary btn-sm me-2"><i class="fa-solid fa-code"></i> Web
                                    Embed</button>
                                <button class="btn btn-outline-primary btn-sm me-2"><i class="fa-solid fa-print"></i> Print
                                    Soal</button>
                                <button class="btn btn-sm me-2 btn-outline-primary"><i
                                        class="fa-solid fa-square-poll-horizontal"></i> Hasil</button>
                                <button class="btn btn-sm me-2 btn-outline-primary"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</button>
                                {{-- ini adalah akhir dari tombol kuis --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="d-lg-flex justify-content-between">
                <span>
                    <h5>Soal Kuis &bull; 3 Pertanyaan</h5>
                </span>
                <span class="d-flex">
                    {{-- href="{{ route("pustaka.kuis.editor","form_jenis") }}" --}}
                    <button  class="btn btn-outline-secondary btn-sm me-1" data-bs-toggle="modal"
                    data-bs-target="#modal-pilih-soal"><i class="fa-solid fa-plus"></i> Buat
                        Soal</button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm me-1 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Tampilkan Kuis
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route("pustaka.kuis.preview","cbt") }}">Mode CBT</a></li>
                            <li><a class="dropdown-item" href="{{ route("pustaka.kuis.preview","form") }}">Mode Form</a></li>
                            <li><a class="dropdown-item" href="{{ route("pustaka.kuis.preview","cbt") }}">Mode Embed</a></li>
                        </ul>
                    </div>
                </span>
            </div>
            <div class="mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <h6>1. Pilihan Ganda &bull; 10 Poin</h6>
                        <Button class="btn-success btn btn-sm rounded-5 px-2"><i class="fa-solid fa-file-pen me-1"></i>
                            Edit</Button>
                    </div>
                    <div class="card-body">
                        <p>Planet mana yang lebih dekat dengan matahari?</p>
                        <div id="jawaban" class="row mx-2">
                            <div class="col-md-auto form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1" checked>
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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <h6>2. Isian Matematis &bull; 10 Poin</h6>
                        <Button class="btn-success btn btn-sm rounded-5 px-2"><i class="fa-solid fa-file-pen me-1"></i>
                            Edit</Button>
                    </div>

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
                            <input type="number" placeholder="Jawab disini" disabled value="300" class="form-controll">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <h6>3. Pilihan Ganda &bull; 10 Poin</h6>
                        <Button class="btn-success btn btn-sm rounded-5 px-2"><i class="fa-solid fa-file-pen me-1"></i>
                            Edit</Button>
                    </div>
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
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6>Daftar Peserta</h6>
                    <button class="btn btn-sm rounded-5 btn-success">Atur</button>
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex my-1 justify-content-between align-items-start rounded-4">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Yogie prayoga</div>
                            </div>
                            <span class="badge bg-danger rounded-pill">0/3</span>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6>Pengaturan Kuis</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Pengulangan kuis</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                            <label class="form-check-label visually-hidden" for="flexSwitchCheckChecked">Checked switch
                                checkbox input</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Perlihatkan Nilai</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                checked>
                            <label class="form-check-label visually-hidden" for="flexSwitchCheckChecked">Checked switch
                                checkbox input</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Kuis Aktif</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                            <label class="form-check-label visually-hidden" for="flexSwitchCheckChecked">Checked switch
                                checkbox input</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="waktu_mulai">Waktu Dibuka</label>
                        <input type="text" id="waktu_mulai" class="form-control" placeholder="Pilih Waktu Di buka">
                    </div>
                    <div class="mt-2">
                        <label for="waktu_mulai">Waktu berakhir</label>
                        <input type="text" id="waktu_berakhir" class="form-control"
                            placeholder="Pilih Waktu berakhir">
                    </div>
                    <div class="mt-2">
                        <label for="waktu_mulai">Lama Waktu</label>
                        <input type="text" id="waktu" class="form-control">
                    </div>
                    <button class="btn-primary btn btn-sm mt-3 btn-block">Simpan</button>

                </div>
            </div>
        </div>
    </div>

    @include("pages.dashboard.partials.modal_buat_soal");


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var waktu_mulai_el = document.getElementById("waktu_mulai");
            var waktu_berakhir_el = document.getElementById("waktu_berakhir");
            var waktu_el = document.getElementById("waktu");

            flatpickr(waktu_mulai_el, {
                enableTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i",
            });
            flatpickr(waktu_berakhir_el, {
                enabledTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i"
            });
            flatpickr(waktu_el, {
                enableTime: true,
                time_24hr: true,
                dateFormat: "H:i",
                noCalendar: true
            })


        })
    </script>
@endsection
