<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor - @yield("title")</title>
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('mazer/extensions/toastify-js/src/toastify.css') }}">
    <script src="{{ asset('assets/module/ckeditor/ckeditor.js') }}"></script>
     @yield("css")
</head>

<body>
    <nav class="navbar container navbar-light d-flex justify-items-between ">
        <div class="">
            <a  onclick="BackToQuiz()"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" onclick="BackToQuiz()">
                <img src="{{ asset('images/tepianLogo.svg') }}" style="transform: scale(2.5);">
            </a>
        </div>
        @if (isset($soal))
        <h5>Edit Soal</h5>
        @else
        <h5>Buat Soal</h5>
            {{-- <div class="" style="width: 300px">
                <select class="form-select" aria-label="Default select example">
                    <option selected><i class="fa-solid fa-list-ul"></i> Pilihan Ganda</option>
                    <option value="1">Benar atau Salah</option>
                    <option value="2">Isian Singkat</option>
                    <option value="3">Menjodohkan</option>
                    <option value="4">Mengurutkan</option>
                </select>
            </div> --}}

        @endif
      
    </nav>


    @yield("editor")
    </div>
    {{-- <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('mazer/extensions/toastify-js/src/toastify.js') }}"></script>

    


    @yield("js")

</body>

</html>
