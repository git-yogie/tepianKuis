@extends('template.dashboard.dasboard-template')

@section('title', 'Pustaka Kuis')

@section('css')

    <style>
        .kuis-item {
            cursor: pointer;
            transition: 80ms ease-in-out;
        }

        .kuis-item:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('page-heading', 'Pustaka Kuis')

@section('main')
    <div class="d-flex justify-content-between mb-3">
        <div class="col-auto">
            <label class="visually-hidden" for="autoSizingInputGroup"><i class="bi bi-search"></i></label>
            <div class="input-group">
                <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Cari Kuis">
            </div>
        </div>

        <button class="btn btn-primary">
            <i class="bi bi-file-earmark-plus"></i> Buat Kuis
        </button>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <a href="{{ route("pustaka.kuis","kuis-perangkat-lunak") }}" class="card rounded-4 kuis-item">
                <div class="card-body p-3">
                    <img src="{{ asset('images/quiz-picture.png') }}" class="card-img rounded-4" alt=""
                        srcset="">
                    <div class="p-2">
                        <span class="badge rounded-pill text-bg-primary">Kuis</span>
                        <span class="badge rounded-pill text-bg-success">Aktif</span>
                        <h5 class="mt-2 ml-1">Kuis Perangkat Lunak</h3>
                            <p class="text-muteed" style="font-size: 12px">Informatika &bull; 20 Peserta &bull; 16 Soal
                            </p>
                            {{-- <div class="d-flex justify-content-between">
                                <button class="btn btn-info btn-block mx-1 rounded-2">Edit</button>
                                <button class="btn btn-danger btn-block mx-1 rounded-3">Hapus</button>
                            </div> --}}
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <div class="card rounded-4 kuis-item">
                <div class="card-body p-3">
                    <img src="{{ asset('images/quiz-picture.png') }}" class="card-img rounded-4" alt=""
                        srcset="">
                    <div class="p-2">
                        <span class="badge rounded-pill text-bg-primary">Kuis</span>
                        <span class="badge rounded-pill text-bg-success">Aktif</span>
                        <h5 class="mt-2 ml-1">Kuis Perangkat Lunak</h3>
                            <p class="text-muteed" style="font-size: 12px">Informatika &bull; 20 Peserta &bull; 16 Soal
                            </p>
                            {{-- <div class="d-flex justify-content-between">
                                <button class="btn btn-info btn-block mx-1 rounded-2">Edit</button>
                                <button class="btn btn-danger btn-block mx-1 rounded-3">Hapus</button>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card rounded-4 kuis-item">
                <div class="card-body p-3">
                    <img src="{{ asset('images/quiz-picture.png') }}" class="card-img rounded-4" alt=""
                        srcset="">
                    <div class="p-2">
                        <span class="badge rounded-pill text-bg-primary">Kuis</span>
                        <span class="badge rounded-pill text-bg-success">Aktif</span>
                        <h5 class="mt-2 ml-1">Kuis Perangkat Lunak</h3>
                            <p class="text-muteed" style="font-size: 12px">Informatika &bull; 20 Peserta &bull; 16 Soal
                            </p>
                            {{-- <div class="d-flex justify-content-between">
                                <button class="btn btn-info btn-block mx-1 rounded-2">Edit</button>
                                <button class="btn btn-danger btn-block mx-1 rounded-3">Hapus</button>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card rounded-4 kuis-item">
                <div class="card-body p-3">
                    <img src="{{ asset('images/quiz-picture.png') }}" class="card-img rounded-4" alt=""
                        srcset="">
                    <div class="p-2">
                        <span class="badge rounded-pill text-bg-primary">Kuis</span>
                        <span class="badge rounded-pill text-bg-success">Aktif</span>
                        <h5 class="mt-2 ml-1">Kuis Perangkat Lunak</h3>
                            <p class="text-muteed" style="font-size: 12px">Informatika &bull; 20 Peserta &bull; 16 Soal
                            </p>
                            {{-- <div class="d-flex justify-content-between">
                                <button class="btn btn-info btn-block mx-1 rounded-2">Edit</button>
                                <button class="btn btn-danger btn-block mx-1 rounded-3">Hapus</button>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        const container = document.getElementById("list-kuis")
        const kuis = [
            {
                judul: "Kuis Perangkat Lunak",
                kategori: "Informatika",
                peserta: 20,
                soal: 16,
                status: false,
                gambar: "{{ asset('images/quiz-picture.png') }}"
            },
            {
                judul: "Kuis Perangkat Keras",
                kategori: "Informatika",
                peserta: 20,
                soal: 16,
                status: true,
                gambar: "{{ asset('images/quiz-picture.png') }}"
            }
        ];

        function CardElement(judul, gambar, active, mapel, peserta, jumlahSoal) {

            return `
            <div class="col-lg-4">
            <div class="card rounded-4 kuis-item">
                <div class="card-body p-3">
                    <img src="${gambar}" class="card-img rounded-4" alt=""
                        srcset="">
                    <div class="p-2">
                        <span class="badge rounded-pill text-bg-primary">Kuis</span>
                        <span class="badge rounded-pill text-bg-${active ? "success" : "danger" }">${active ? "aktif" : "Tidak aktif" }</span>
                        <h5 class="mt-2 ml-1">${judul}</h3>
                            <p class="text-muted" style="font-size: 12px">${mapel} &bull; ${peserta} Peserta &bull; ${jumlahSoal}
                            </p>
                    </div>
                </div>
            </div>
        </div>
            `;
        

        }

        populateKuis(container,kuis);

        // function untuk populasi Data
        function populateKuis(el,data) {
            var temp = "";
            data.forEach(iterate => {
                
                
                temp += CardElement(iterate.judul,iterate.gambar,iterate.active,iterate.kategori,iterate.soal)
            });
            el.innherHTML = temp;

        }
    </script>
@endsection
