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

    <div class="row" id="cardContainer">
       
          
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
                preview.attr('src', '{{ asset('files') }}/' + message);
                document.getElementById("file_name").value = message
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
    </script>
@endsection
