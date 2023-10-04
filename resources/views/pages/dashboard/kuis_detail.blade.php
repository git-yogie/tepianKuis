@extends('template.dashboard.dasboard-template')

@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/dracula.min.css">
    <link rel="stylesheet" href="{{ asset('mazer/extensions/cropter/ijaboCropTool.min.css') }}">

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
                                {{ $var[0]->mata_pelajaran }} &bull; <i class="fa-solid fa-users"></i> <span
                                    id="jumlahPeserta">20</span> Peserta &bull; <i class="fa-solid fa-clipboard-list"></i>
                                <span id="jumlahSoal"> 16 </span> Soal
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
                                <a href="{{ route('quiz.download', $var[0]->kuis_code) }}"
                                    class="btn btn-outline-primary btn-sm me-2"><i class="fa-solid fa-file-arrow-down"></i>
                                    Json</a>
                                <a href="{{ route('hasil.daftar.peserta', $var[0]->kuis_code) }}"
                                    class="btn btn-sm me-2 btn-outline-primary"><i
                                        class="fa-solid fa-square-poll-horizontal"></i> Hasil</a>
                                <button id="edit_kuis" class="btn btn-sm me-2 btn-outline-primary"><i
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
                    <div class="">
                        <select class="form-select" id="viewPerPage" aria-label="select example">
                            <option selected value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </span>
            </div>
            <div class="mt-3" id="containerSoal">

            </div>
            <div class="text-center">
                <div class="btn-group me-2" id="pagination-buttons" role="group" aria-label="First group">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6>Daftar Peserta</h6>
                    <button class="btn btn-sm rounded-5 btn-success" id="atur_peserta">Atur</button>
                </div>
                <div class="card-body overflow-auto" style="height: 300px">
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
                                            Pilih Semua
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
                                            Pilih Semua
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
    <div class="modal fade" id="form_edit" tabindex="-1" aria-labelledby="form_edit" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_kuis">Edit Kuis</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <form id="form_buat_kuis">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $var[0]->id }}" id="idIn">
                                    @csrf

                                    <div class="form-group">
                                        <label for="judul_kuis">Judul Kuis </label>
                                        <input id="judul_kuis" name="judul_kuis" value="{{ $var[0]->nama }}"
                                            type="text" placeholder="Judul Kuis" class="form-control" />
                                        <div class="" id="judul_kuis_field">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_kuis">Mata Pelajaran </label>
                                        <select name="mata_pelajaran" id="mata_pelajaran" class="form-select"
                                            aria-label="Default select example">]
                                            <option value="Pendidikan Kewarganegaraan"
                                                {{ $var[0]->mata_pelajaran == 'Pendidikan Kewarganegaraan' ? 'selected' : '' }}>
                                                Pendidikan Kewarganegaraan</option>
                                            <option value="Pendidikan Agama"
                                                {{ $var[0]->mata_pelajaran == 'Pendidikan Agama' ? 'selected' : '' }}>
                                                Pendidikan Agama</option>
                                            <option value="Matematika"
                                                {{ $var[0]->mata_pelajaran == 'Matematika' ? 'selected' : '' }}>Matematika
                                            </option>
                                            <option value="Bahasa Inggris"
                                                {{ $var[0]->mata_pelajaran == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa
                                                Inggris</option>
                                            <option value="Bahasa Indonesia"
                                                {{ $var[0]->mata_pelajaran == 'Bahasa Indonesia' ? 'selected' : '' }}>
                                                Bahasa indnesia</option>
                                            <option value="Fisika"
                                                {{ $var[0]->mata_pelajaran == 'Fisika' ? 'selected' : '' }}>FIsika</option>
                                            <option value="Biologi"
                                                {{ $var[0]->mata_pelajaran == 'Biologi' ? 'selected' : '' }}>Biologi
                                            </option>
                                            <option value="IPA"
                                                {{ $var[0]->mata_pelajaran == 'IPA' ? 'selected' : '' }}>IPA</option>
                                            <option value="IPS"
                                                {{ $var[0]->mata_pelajaran == 'IPS' ? 'selected' : '' }}>IPS</option>
                                            <option value="PPKN"
                                                {{ $var[0]->mata_pelajaran == 'PPKN' ? 'selected' : '' }}>PPKN</option>
                                            <option value="Informatika"
                                                {{ $var[0]->mata_pelajaran == 'Informatika' ? 'selected' : '' }}>
                                                Informatika</option>
                                            <option value="TIK"
                                                {{ $var[0]->mata_pelajaran == 'TIK' ? 'selected' : '' }}>TIK</option>
                                        </select>
                                        <div class="" id="mata_pelajaran_field">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_kuis">Tingkatan </label>
                                        <select name="tingkatan" id="tingkatan_kuis"class="form-select"
                                            aria-label="Default select example">
                                            <option value="" selected disabled>Pilih Tingkat</option>
                                            <option value="Perguruan Tinggi"
                                                {{ $var[0]->tingkatan == 'TIK' ? 'selected' : '' }}>Perguruan Tinggi
                                            </option>
                                            <option value="SMK" {{ $var[0]->tingkatan == 'SMK' ? 'selected' : '' }}>SMK
                                            </option>
                                            <option value="SMA" {{ $var[0]->tingkatan == 'SMA' ? 'selected' : '' }}>SMA
                                            </option>
                                            <option value="SMP" {{ $var[0]->tingkatan == 'SMP' ? 'selected' : '' }}>SMP
                                            </option>
                                            <option value="SD" {{ $var[0]->tingkatan == 'SD' ? 'selected' : '' }}>SD
                                            </option>
                                            <option value="Umum" {{ $var[0]->tingkatan == 'Umum' ? 'selected' : '' }}>TK
                                            </option>
                                        </select>
                                        <div class="" id="tingkatan_kuis_field">

                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-5">
                            <label for="">Upload Baner Kuis Disini</label>
                            <input class="form-control" name="avatar" type="file" id="banner">
                            <img src="{{ $var[0]->banner != null ? asset('files/' . $var[0]->banner) : asset('images/quiz-picture.png') }}"
                                id="image_preview" alt="mdo" style="width: 200px;" class="image-preview mt-2">
                            <input type="hidden" id="file_name" name="file_name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tambah-peserta">Simpan Perubahan</button>
                </div>
                </form>
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
    <script src="{{ asset('mazer/extensions/cropter/ijaboCropTool.min.js') }}"></script>
    <script>
        var preview = $("#image_preview");

        $("#banner").ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['upload', 'kembali'],
            buttonsColor: ['#3498db', '#e74c3c', -15],
            processUrl: '{{ route('banner_upload') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                preview.attr('src', '{{ asset('files') }}/' + message);
                document.getElementById("file_name").value = message
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });

        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });
        const jumlahSoal = document.getElementById("jumlahSoal");
        const deletePrompt = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger mx-3',
                cancelButton: 'btn btn-success'
            },
            buttonsStyling: false
        })

        const viewPerPage = document.getElementById("viewPerPage");

        let itemsPerPage = 5;
        let currentPage = 1;


        viewPerPage.addEventListener("change", function() {
            itemsPerPage = viewPerPage.value;
            currentPage = 1;
            createPaginationButtons();
            displayData()
        });

        var dsa = window.location.protocol + "//" + window.location.host + "/api";

        var dataSoal = [];
        const soalContainer = document.getElementById("containerSoal");

        function loadSoal() {
            axios.get(dsa + "/soal/{{ $var[0]->kuis_code }}")
                .then(function(response) {
                    const data = response.data.data;
                    dataSoal = data;
                    console.log(dataSoal[0]);
                    jumlahSoal.innerHTML = dataSoal.length;
                    document.getElementById("jumlahPertanyaan").innerHTML = "Soal Kuis &bull; " + data
                        .length +
                        " Pertanyaan";
                    displayData();
                    createPaginationButtons();
                })
                .catch(function(error) {

                })
        }

        function displayData() {
            soalContainer.innerHTML = '';
            console.log(dataSoal[0]);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            for (let i = startIndex; i < endIndex && i < dataSoal.length; i++) {
                soalContainer.appendChild(soal(dataSoal[i]));
            }

        }

        function createPaginationButtons() {
            const paginationButtons = document.getElementById('pagination-buttons');
            paginationButtons.innerHTML = ''; // Menghapus tombol sebelumnya

            const totalPages = Math.ceil(dataSoal.length / itemsPerPage);
            //   <button type="button" class="btn btn-outline-secondary">1</button>
            for (let page = 1; page <= totalPages; page++) {
                const button = document.createElement('button');
                if (page == 1) {
                    button.classList.add("btn", "btn-primary", "btn-pagination")
                } else {
                    button.classList.add("btn", "btn-outline-secondary", "btn-pagination")
                }
                button.textContent = page;
                const buttons = document.querySelectorAll('.btn-pagination');
                button.addEventListener('click', (e) => {
                    currentPage = page;

                    // Mengubah kelas tombol yang diklik
                    const buttons = document.querySelectorAll('.btn-pagination');
                    buttons.forEach((btn) => {
                        if (btn === e.target) {
                            btn.classList.remove('btn-outline-secondary');
                            btn.classList.add('btn-primary');
                        } else {
                            btn.classList.remove('btn-primary');
                            btn.classList.add('btn-outline-secondary');
                        }
                    });

                    displayData();
                });
                paginationButtons.appendChild(button);
            }
        }
        loadSoal();
    </script>
    <script src="{{ asset('assets/js/kuisDetail/clipboard_doc.js') }}"></script>
    <script src="{{ asset('assets/js/kuisDetail/konfigurasi.js') }}"></script>
    <script src="{{ asset('assets/js/kuisDetail/kuis.js') }}"></script>
@endsection
