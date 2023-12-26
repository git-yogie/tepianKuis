@extends('template.main-page.main-page')

@section('title', 'TepianKuis - LandingPage')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/dracula.min.css">
@endsection

@section('main')
    <div class="container">
        <div class="px-4 py-5 my-5 mb-5 text-center">
            {{-- <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
            <h1 class="display-5 fw-bold text-body-emphasis">Buat Kuis dengan cepat<br> dengan <span
                    class="text-success">Tepian Kuis</span></h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Tepian Kuis adalah Editor Kuis yang simple, fleksible dan mudah digunakan, yang
                    memudahkan anda membuat kuis atau evaluasi pada aplikasi media pembelajaran anda!</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('daftar') }}" type="button" class="btn btn-primary btn-lg px-4 gap-3">Mulai Sekarang</a>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row p-2  pe-lg-0 pt-lg-3 align-items-center rounded-3 border shadow-lg">
                <div class="col-lg-5 p-3 p-lg-5 pt-lg-3">
                    <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Tepian Kuis
                    </h1>
                    <p class="lead">Mulai seperti yang anda inginkan, tambahkan lebih sedikit kode untuk menyematkan tepian kuis ke website anda</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Coba
                            Sekarang</button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Docs</button>
                    </div>
                </div>
                <div class="col-lg-6 p-3 m-2  overflow-visible  shadow-lg rounded-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#view_tab"
                                type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">View</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#code_tab"
                                type="button" role="tab" aria-controls="profile-tab-pane"
                                aria-selected="false">Javascript</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="view_tab" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div id="kuis"></div>
                        </div>
                        <div class="tab-pane fade" id="code_tab" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <pre><code class="language-html">
&lt;div id="kuis"&gt;&lt;/div&gt;
&lt;script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"&gt;&lt;/script&gt;
&lt;script src="http://127.0.0.1:8000/library/tepian.min.js"&gt;&lt;/script&gt;
&lt;script&gt;
   var elementKuis = document.getElementById("kuis");
   var kuis = new tepianKuis(elementKuis, {
      Key: "Your API Key",
      quiz : "Your Quiz Code",
      title:"Your Quiz Title"
   })
&lt;/script&gt;
                             </code></pre>
                        </div>

                    </div>
                </div>
                <div id="kuis"></div>
            </div>
        </div>
    </div>
    </div>
    <div class="container px-4">

        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="col d-flex flex-column align-items-start gap-2">
                <h2 class="fw-bold text-body-emphasis">Memulai </h2>
                <p class="text-body-secondary">Jelajahi fitur-fitur hebat kami, seperti integrasi Kuis, analisis hasil,
                    dan evaluasi khusus. dashboard kami akan mendukung segala kebutuhan media pembelajaran anda,Jadilah
                    pahlawan di balik pengalaman belajar yang memukau, di mana pengetahuan bertemu dengan interaktifitas
                    yang tak terlupakan.</p>
            </div>

            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col d-flex flex-column gap-2">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3 p-2"
                            style="width: 50px">
                            <i class="fa-solid fa-vial-circle-check"></i>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Buat Kuis</h4>
                        <p class="text-body-secondary">Buat kuis dengan mudah, dengan editor kuis kami!</p>
                    </div>
                    <div class="col d-flex flex-column gap-2">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3 p-2"
                            style="width: 50px">
                            <i class="fa-brands fa-js"></i>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Integrasi dengan Web Anda.</h4>
                        <p class="text-body-secondary">Integrasikan kuis dengan halaman web anda.</p>
                    </div>
                    <div class="col d-flex flex-column gap-2">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3 p-2"
                            style="width: 50px">
                            <i class="fa-solid fa-comment"></i>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Umpan Balik langsung</h4>
                        <p class="text-body-secondary">Tepian Kuis akan memberikan Feedback langsung terhadap hasil
                            pekerjaan siswa anda!</p>
                    </div>
                    <div class="col d-flex flex-column gap-2">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3 p-2"
                            style="width: 50px">
                            <i class="fa-regular fa-clipboard"></i>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Buat Evaluasi khusus</h4>
                        <p class="text-body-secondary">anda bisa mengundang siswa anda untuk memberikan mereka Evaluasi
                            khusus!</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="http://127.0.0.1:8000/library/tepian.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });
    </script>
    <script>
        var elementKuis = document.getElementById("kuis");
        var kuis = new tepianKuis(elementKuis, {
            Key: "NLyYehL6Cr7hbcoTk9m1LbmP42Ji3TVy",
            quiz: "SPqS",
            title: "Tepian Kuis"
        })
    </script>
@endsection
