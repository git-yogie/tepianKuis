@extends('template.dashboard.dasboard-template')

@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/dracula.min.css">

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
                            <img src="{{ $var[0]->banner != null ? asset('files/' . $var[0]->banner) : asset('images/quiz-picture.png') }}"
                                style="width:100px; height:100px;" class="card-img rounded-4" alt="" srcset="">
                        </div>
                        <div class="col-md-9">
                            <h3>{{ $var[0]->nama }}</h3>
                            <p class="text-muteed" style="font-size: 12px"><i class="fa-solid fa-graduation-cap"></i>
                                {{ $var[0]->mata_pelajaran }} &bull; <i class="fa-solid fa-users"></i> 20 Peserta &bull; <i
                                    class="fa-solid fa-clipboard-list"></i> 16 Soal
                            </p>
                            <span class="d-flex align-items-baseline"><i class="fa-solid fa-key me-3"></i><input
                                    style="width: 40%" class="form-control form-control-sm" type="text"
                                    placeholder="kode kuis" value="{{ $var[0]->kuis_code }}" disabled
                                    aria-label=".form-control-sm example"> <button
                                    class="btn btn-outline-primary btn-sm ms-2"><i class="fa-solid fa-copy"></i></button>
                            </span>
                            <div class="d-flex mt-4">
                                {{-- ini adalah tombol dari kuis --}}
                                <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#webEmbed"><i class="fa-solid fa-code"></i> Web
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
                    <h5 id="jumlahPertanyaan"></h5>
                </span>
                <span class="d-flex">
                    {{-- href="{{ route("pustaka.kuis.editor","form_jenis") }}" --}}
                    <button class="btn btn-outline-secondary btn-sm me-1" data-bs-toggle="modal"
                        data-bs-target="#modal-pilih-soal"><i class="fa-solid fa-plus"></i> Buat
                        Soal</button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm me-1 dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Tampilkan Kuis
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="{{ route('pustaka.kuis.preview', 'cbt') . $var[0]->kuis_code }}">Mode CBT</a></li>
                            <li><a class="dropdown-item" href="{{ route('pustaka.kuis.preview', 'form') }}">Mode Form</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('pustaka.kuis.preview', 'cbt') }}">Mode Embed</a>
                            </li>
                        </ul>
                    </div>
                </span>
            </div>
            <div class="mt-3" id="containerSoal">

            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6>Daftar Peserta</h6>
                    <button class="btn btn-sm rounded-5 btn-success" id="atur_peserta">Atur</button>
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-numbered" id="listPeserta">

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
                            <input class="form-check-input" type="checkbox" role="switch" id="bisaUlang">
                            <label class="form-check-label visually-hidden" for="flexSwitchCheckChecked">Checked switch
                                checkbox input</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Perlihatkan Nilai</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="tampilkanPoin">
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
                        <label for="waktu_mulai">Lama Waktu Kuis</label>
                        <input type="text" id="waktu" class="form-control">
                    </div>
                    <button class="btn-primary btn btn-sm mt-3 btn-block" id="simpan_konfigurasi">Simpan</button>

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="id_kuis" value="{{ $var[0]->id }}">
    @include('pages.dashboard.partials.modal_buat_soal');
    <div class="modal fade" id="modalPeserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Peserta Ke kuis</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <button class="btn btn-sm btn-primary" id="hapusPeserta"><i class="fa-solid fa-chevron-left"></i>
                            Hapus</button>
                        <button class="btn btn-sm btn-primary" id="tambahkanPeserta">Tambahkan<i
                                class="fa-solid fa-chevron-right"></i> </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5>Peserta Terdaftar</h5>
                                    <div class="">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="checkPeserta">
                                        <label class="form-check-label" for="checkPeserta">
                                            Piliha Semua
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered" id="peserta_container">
                                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation me-3"></i>
                                            <div>
                                                <strong>Perhatian!</strong> Belum ada Peserta ditambahkan
                                            </div>
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5>Peserta Kuis</h5>
                                    <div class="">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="checkPesertaKuis">
                                        <label class="form-check-label" for="checkPesertaKuis">
                                            Piliha Semua
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered" id="peserta_kuis">
                                        <div class="alert rounded-pils alert-primary d-flex align-items-center"
                                            role="alert">
                                            <i class="fa-solid fa-triangle-exclamation me-3"></i>
                                            <div>
                                                <strong>Perhatian!</strong> Belum ada Peserta ditambahkan
                                            </div>
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @include('pages.dashboard.components.modal_web_embed');

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('mazer/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('mazer/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <script src="{{ asset('assets/js/soal_model.js') }}"></script>
    <script src="{{ asset('assets/js/kuisDetail/aturPeserta.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>

    <!-- and it's easy to individually load additional languages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/go.min.js"></script>

    <script>
        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });



        var dsa = window.location.protocol + "//" + window.location.host + "/api";

        document.addEventListener("DOMContentLoaded", function() {
          

            const soalContainer = document.getElementById("containerSoal");

            function loadSoal(){
                axios.get(dsa + "/soal/{{ $var[0]->kuis_code }}")
                .then(function(response) {
                    const data = response.data.data;
                    console.log(data.length);
                    document.getElementById("jumlahPertanyaan").innerHTML = "Soal Kuis &bull; " + data.length +
                        " Pertanyaan"
                    data.forEach(element => {
                        soalContainer.appendChild(soal(element));
                    });
                })
                .catch(function(error) {

                })
            }
            loadSoal();

            
           
        })

    </script>
    <script src="{{ asset('assets/js/kuisDetail/clipboard_doc.js') }}"></script>
    <script src="{{ asset('assets/js/kuisDetail/konfigurasi.js') }}"></script>



@endsection
