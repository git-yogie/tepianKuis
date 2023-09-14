@extends('pages.dashboard.kuis_editor.template.editor')

@section('title', 'Pilihan Ganda')
@section('css')
@endsection


@section('editor')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
    <div class="container">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between ">
                <h4 class="card-title">{{ $var[0]->nama }} &bull;
                    <input style="width:20%;" type="text" name="" id="judul_soal" placeholder="Pertanyan 1"
                        class="d-inline form-control">
                    <input style="width:15%;" type="number" name="" id="poin" placeholder="poin"
                        class="d-inline form-control">
                </h4>
                <div class="">
                    <button class="btn btn-sm btn-primary" onclick="renderToJson()"><i class="fa-solid fa-rotate"></i>
                        Simpan</button>
                        @if (isset($soal))
                    @else
                    <button class="btn btn-sm btn-primary d-inline" onclick="nextQuestion()" > Soal Selanjutnya <i
                        class="fa-solid fa-arrow-right"></i></button>
         
                    @endif
                </div>
                 
            </div>
            <div class="card-body">
                <textarea name="editor1" id="editor1" rows="10" cols="80">
                
            </textarea>
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="">
                        <h6 class="mt-4 mx-5">Jawaban</h6>

                    </div>
                    <input  type="text" name="" id="jawabanSoal" placeholder="Isi jawaban dari pertanyaan"
                    class="d-inline form-control">
                   
                </div>
            </div>


        </div>
    </div>
@endsection



@section('js')
    <script>
        const baseUrl = window.location.protocol + "//" + window.location.host + "/api";
        const judul = document.getElementById("judul_soal");
        const poin = document.getElementById("poin");

        var pilihan_editor_config = {
            // Konfigurasi toolbar
            toolbar: [{
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                    'RemoveFormat', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'JustifyLeft',
                    'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Image'
                ]
            }, ],

        
            // Opsi tambahan
            language: 'en', // Ganti dengan kode bahasa yang diinginkan (misalnya 'en' untuk Inggris, 'id' untuk Indonesia)
            height: 100, // Tinggi editor (dalam piksel)
            width: '100%' // Lebar editor (dalam persen atau piksel)
        }

        var id_soal = null;
        var pilihanEditor = [];
        const jawabanSoal = document.getElementById("jawabanSoal");
        var opsiId = 0;

        @if (isset($soal))
            id_soal = "{{ $soal->id }}"
            replaceText(id_soal)
        @else
          
        @endif



        CKEDITOR.replace('editor1');

        function BackToQuiz(){
            window.location.assign(`{{ route("pustaka.kuis",$var[0]->kuis_code) }}`)
        }

        function nextQuestion(){
            window.location.reload()
        }


        function setJawaban(id) {

            for (let index = 0; index < pilihanEditor.length; index++) {
                if (index == id) {
                    pilihanEditor[index].benar = true;
                } else {
                    pilihanEditor[index].benar = false;
                }
            }
            console.log(pilihanEditor);

        }

        function removePilihanEditor() {
            if (pilihanEditor.length <= 2) {

            } else {
                pilihanEditor.pop()
                opsi.removeChild(opsi.lastElementChild);
            }
        }

        function renderToJson() {
            var data = {
                "pertanyaan": CKEDITOR.instances.editor1.getData(),
                "jawaban": jawabanSoal.value
            }
           console.log(data);
            sendWhat(data);
        }

        function sendWhat(data) {
            var path = window.location.pathname.split("/");
            var kuis_code = path[path.length - 1];
            var jenis = path[path.length - 2];
            var post = {
                judul: judul.value,
                poin: poin.value,
                data: data,
                kuis_code: kuis_code,
                jenis_kuis: jenis,
            }
            if (post.judul.length == 0 || post.poin.length == 0) {
                Toastify({
                    text: "Judul atau Poin masih Kosong",
                    duration: 1000,
                    style: {
                        background: "linear-gradient(to right, #e74c3c, #c0392b)",
                    },
                }).showToast();
            } else if (post.data.pertanyaan.length == 0) {
                Toastify({
                    text: "Pertanyaan masih kosong!",
                    duration: 1000,
                    style: {
                        background: "linear-gradient(to right, #e74c3c, #c0392b)",
                    },
                }).showToast();
            } else if (post.data.jawaban.length == 0) {
                Toastify({
                    text: "jawaban masih kosong!",
                    duration: 1000,
                    style: {
                        background: "linear-gradient(to right, #e74c3c, #c0392b)",
                    },
                }).showToast();

            } else {
                if (id_soal != null) {
                    axios.post(baseUrl + "/soal/edit/" + id_soal, post)
                        .then(function(response) {
                            console.log(response.data);
                            Toastify({
                                text: "Soal Tersimpan!",
                                duration: 3000,
                                style: {
                                    background: "linear-gradient(to right, #2ecc71, #27ae60)",
                                },
                            }).showToast();
                        })
                        .catch(function(error) {
                            Toastify({
                                text: "Gagal Menyimpan : " + error,
                                duration: 5000,
                                style: {
                                    background: "linear-gradient(to right, #e74c3c, #c0392b)",
                                },
                            }).showToast();
                        })
                } else {
                    axios.post(baseUrl + "/soal", post)
                        .then(function(response) {
                            console.log(response.data);
                            Toastify({
                                text: "Soal Tersimpan!",
                                duration: 3000,
                                style: {
                                    background: "linear-gradient(to right, #2ecc71, #27ae60)",
                                },
                            }).showToast();
                            id_soal = response.data.id_soal
                        })
                        .catch(function(error) {
                            Toastify({
                                text: "Gagal Menyimpan : " + error,
                                duration: 5000,
                                style: {
                                    background: "linear-gradient(to right, #e74c3c, #c0392b)",
                                },
                            }).showToast();
                        })
                }

            }
        }

        function validatedOptions(data) {

            var validate_fail = false;
            data.forEach(elemen => {
                if (elemen.text.length === 0) {
                    validate_fail = true;
                }
            });
            return validate_fail;
        }

        function replaceText(id_soal) {
            axios.get(baseUrl + "/soal/show/" + id_soal)
                .then(function(response) {
                    const data = response.data.data
                    const soal = JSON.parse(data.soal_data);
                    console.log(soal)
                    judul.value = data.judul_soal;
                    poin.value = data.poin;
                    CKEDITOR.instances.editor1.setData(soal.pertanyaan)
                    jawabanSoal.value = soal.jawaban
                })
                .catch(function(error) {
                    console.error(error);
                })
        }
    </script>
@endsection
