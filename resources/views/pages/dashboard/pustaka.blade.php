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
    <link rel="stylesheet" href="{{ asset('mazer/extensions/cropter/ijaboCropTool.min.css') }}">
@endsection

@section('page-heading', 'Pustaka Kuis')

@section('main')
    @include('pages.dashboard.components.kuis.modal_addKuis');
    <div class="d-flex justify-content-between mb-3">
        <div class="col-auto">
            <label class="visually-hidden" for="autoSizingInputGroup"><i class="bi bi-search"></i></label>
            <div class="input-group">
                <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Cari Kuis">
            </div>
        </div>

        <button class="btn btn-primary" id="button_buat_kuis">
            <i class="bi bi-file-earmark-plus"></i> Buat Kuis
        </button>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <a href="{{ route('pustaka.kuis', 'kuis-perangkat-lunak') }}" class="card rounded-4 kuis-item">
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
  var form = this.getElementById("form_buat_kuis");
        <div class="col-lg-4">
            <div class="card rounded-4 kuis-item">
                <div class="card-body p-3">
                    <img src="{{ asset('images/quiz-picture.png') }}" class="card-img rounded-4" alt=""
                        srcset="">
                    <div class="p-2">
                        <span class="badge rounded-pill text-bg-primary">Kuis</span>
                        <span class="badge rounded-pill text-bg-success">SMK</span>
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
    <script src="{{ asset('mazer/extensions/cropter/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/pustaka.js') }}"></script>
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
                preview.attr('src', '{{ asset("files") }}/'+message);
                document.getElementById("file_name").value = message
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
    </script>
@endsection
