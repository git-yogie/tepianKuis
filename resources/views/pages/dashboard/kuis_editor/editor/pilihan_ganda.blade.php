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
                    <button class="btn btn-sm btn-primary d-inline" onclick="nextQuestion()" > Soal Baru <i
                            class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="card-body">
                <textarea name="editor1" id="editor1" rows="10" cols="80">
            </textarea>
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="mt-4">Opsi Jawaban</h6>
                    <div class="d-inline d-flex align-items-center">
                        <Button class="btn btn-primary btn-sm" onclick="addEditor()"><i class="fa-solid fa-plus"></i>
                            Tambah Opsi</Button>
                        <Button class="btn btn-danger btn-sm ms-2" onclick="removePilihanEditor()"><i
                                class="fa-solid fa-minus"></i> kurangi Opsi</Button>
                    </div>
                </div>f
                <div class="row mt-3" id="Opsi">

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
        var opsi = document.getElementById("Opsi");
        var opsiId = 0;

        @if (isset($soal))
            id_soal = "{{ $soal->id }}"
            replaceText(id_soal)
        @else
            addEditor();
            addEditor();
        @endif



        CKEDITOR.replace('editor1');
        function BackToQuiz(){
            window.location.assign(`{{ route("pustaka.kuis",$var[0]->kuis_code) }}`)
        }

        function nextQuestion(){
            window.location.reload()
        }


        function addEditor() {

            if (pilihanEditor.length > 5) {
                alert("Maksimal 6 opsi jawaban")

            } else {

                var id = pilihanEditor.length + 1;

                // elemen input
                var newCol = document.createElement("div");
                newCol.classList.add("col-md-3")
                newCol.classList.add("col-12")
                newCol.classList.add("mb-2")
                newCol.setAttribute("id", "component_pilihan_" + id)


                var flexDiv = document.createElement("div")
                flexDiv.classList.add("d-flex")
                flexDiv.classList.add("justify-content-between")
                flexDiv.classList.add("align-items-baseline")
                flexDiv.classList.add("mb-3")

                var inputDiv = document.createElement("div");

                // elemen input
                var input = document.createElement("input");
                input.setAttribute("type", "radio")
                input.setAttribute("id", "pilihanOpsiJawaban_" + id)
                input.setAttribute("name", "opsiJawaban");
                input.classList.add("form-check-input")
                input.setAttribute("onChange", `setJawaban(${id-1})`)
                // label opsi
                var label = document.createElement("p");
                label.classList.add("d-inline")
                label.classList.add("ms-2")
                label.innerText = "Jawaban " + id

                // elemen editor
                var textArea = document.createElement("textarea")
                textArea.setAttribute("id", "pilihan_" + id)

                // addcomponent
                inputDiv.appendChild(input);
                inputDiv.appendChild(label);
                flexDiv.appendChild(inputDiv)
                // flexDiv.appendChild(buttonDelete);

                // append to parent columnt
                newCol.appendChild(flexDiv)
                newCol.appendChild(textArea);

                opsi.appendChild(newCol);
                CKEDITOR.replace("pilihan_" + id, pilihan_editor_config)

                var newOption = {
                    id: "pilihan_" + id,
                    editor: CKEDITOR.instances["pilihan_" + id],
                    benar: false
                }
                pilihanEditor.push(newOption);
            }


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
                "pilihan": []
            }
            pilihanEditor.forEach(element => {
                var temp = {
                    id: element.id,
                    text: element.editor.getData(),
                    benar: element.benar
                }
                data.pilihan.push(temp)
            });
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
            } else if (validatedOptions(post.data.pilihan)) {
                Toastify({
                    text: "Masih ada Opsi jawaban masih kosong!",
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
                    // document.getElementById("editor1").value = soal.pertanyaan
                    soal.pilihan.forEach(element => {
                        addEditor();
                        CKEDITOR.instances[element.id].setData(element.text);
                        if (element.benar) {
                            document.getElementById(element.id.replace("pilihan_", "pilihanOpsiJawaban_"))
                                .checked = true;
                        }
                    });
                })
                .catch(function(error) {
                    console.error(error);
                })
        }
    </script>
@endsection
