<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor - Pilihan Ganda</title>
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/main/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/module/ckeditor/ckeditor.js') }}"></script>
</head>

<body>
    <nav class="navbar container navbar-light d-flex justify-items-between">
        <div class="">
            <a href="#" onclick="history.back()"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="index.html">
                <img src="{{ asset('images/tepianLogo.svg') }}" style="transform: scale(2.5);">
            </a>
        </div>
        <div class="" style="width: 300px">
            <select class="form-select" aria-label="Default select example">
                <option selected><i class="fa-solid fa-list-ul"></i> Pilihan Ganda</option>
                <option value="1">Benar atau Salah</option>
                <option value="2">Isian Singkat</option>
                <option value="3">Menjodohkan</option>
                <option value="4">Mengurutkan</option>
            </select>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between ">
                <h4 class="card-title">Kuis Perangkat Lunak &bull; <input style="width:20%;" type="text"
                        name="" id="" placeholder="Pertanyan 1" class="d-inline form-control"> <input
                        style="width:15%;" type="number" name="" id="" placeholder="poin"
                        class="d-inline form-control"></h4>
                <div class="">
                    <button class="btn btn-sm btn-primary" onclick="renderToJson()"><i class="fa-solid fa-rotate"></i> Simpan</button>
                    <button class="btn btn-sm btn-primary d-inline"> Soal Selanjutnya <i
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
                </div>
                <div class="row mt-3" id="Opsi">

                </div>
            </div>


        </div>
    </div>
    </div>
    {{-- <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script> --}}
    <script>
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

        CKEDITOR.replace('editor1');
        var pilihanEditor = [];
        var opsi = document.getElementById("Opsi");
        var opsiId = 0;

        addEditor();
        addEditor();

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

                // tombol hapus
                // var buttonDelete = document.createElement("button");
                // buttonDelete.classList.add("btn")
                // buttonDelete.classList.add("btn-sm")
                // buttonDelete.classList.add("btn-danger")
                // buttonDelete.classList.add("d-inline")
                // buttonDelete.setAttribute("id", "delete-pilihan-" + id);
                // buttonDelete.setAttribute("onClick",`removePilihanEditor("component_pilihan_${id}",${id})`)
                // var icon = document.createElement("i")
                // icon.classList.add("fa-solid")
                // icon.classList.add("fa-trash-can")

                // buttonDelete.appendChild(icon)

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
                    id : element.id,
                    text : element.editor.getData(),
                    benar : element.benar
                }
                data.pilihan.push(temp)
            });
            console.log(data)
        }

        
    </script>

</body>

</html>
