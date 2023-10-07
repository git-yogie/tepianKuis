
// axios support
var path = window.location.pathname.split("/");
console.log();
// komponen
const modal_peserta = new bootstrap.Modal(document.getElementById("modalPeserta"));
const tombol_atur = document.getElementById("atur_peserta");

// komponen Modal Atur Data 
const container_peserta = document.getElementById("peserta_container");
const container_peserta_quiz = document.getElementById("peserta_kuis");

const tombolHapus = document.getElementById("hapusPeserta");
const tombolTambah = document.getElementById("tambahkanPeserta");

const checkAllPesertaQuiz = document.getElementById("checkPesertaKuis")
const checkAllPeserta = document.getElementById("checkPeserta")

const listPeserta = document.getElementById("listPeserta");
const jumlahPeserta = document.getElementById("jumlahPeserta");

console.log(listPeserta);

getPeserta()

checkAllPeserta.addEventListener("click", () => {
    
})

checkAllPeserta.addEventListener("click", () => {
    var checkboxTambah = document.querySelectorAll(".tambah-checkbox");
    if (checkAllPeserta.checked) {
        checkboxTambah.forEach((element) => {
            element.checked = true;
        })
    } else {
        checkboxTambah.forEach((element) => {
            element.checked = false;
        })
    }
})

checkAllPesertaQuiz.addEventListener("click", () => {
    var checkboxHapus = document.querySelectorAll(".hapus-checkbox");
    if (checkAllPesertaQuiz.checked) {
        checkboxHapus.forEach((element) => {
            element.checked = true;
        })
    } else {
        checkboxHapus.forEach((element) => {
            element.checked = false;
        })
    }
})


tombolTambah.addEventListener("click", () => {
    var checkboxTambah = document.querySelectorAll(".tambah-checkbox");
    var nilaiCheckboxDicentang = [];

    checkboxTambah.forEach((element) => {
        if (element.checked) {
            nilaiCheckboxDicentang.push(element.value);
        }
    });

    addToKuis(nilaiCheckboxDicentang);
});
tombolHapus.addEventListener("click", () => {
    var checkboxHapus = document.querySelectorAll(".hapus-checkbox");
    var nilaiCheckboxDicentang = [];

    checkboxHapus.forEach((element) => {
        if (element.checked) {
            nilaiCheckboxDicentang.push(element.value);
        }
    });

    removeToKuis(nilaiCheckboxDicentang);
})


tombol_atur.addEventListener("click", () => {
    getPeserta()
    modal_peserta.show();
});

document.addEventListener("click", (e) => {
    var target = e.target.classList;

    console.log(target.contains("tambah_peserta_kuis"))
    if (target.contains("tambah_peserta_kuis")) {
        addToKuis(e.target.getAttribute("data-peserta"));
    } else if (target.contains("hapus_peserta_kuis")) {
        removeToKuis(e.target.getAttribute("data-peserta"));
    }

})

function getPeserta() {
    axios.get(baseUrl + "api/quiz/get/peserta/"+path[path.length - 1])
        .then(function (response) {
            const data_peserta = response.data.peserta;
            const data_peserta_quiz = response.data.peserta_quiz;

            container_peserta.innerHTML = ""
            container_peserta_quiz.innerHTML = ""
            listPeserta.innerHTML = ""
            jumlahPeserta.innerHTML = data_peserta_quiz.length
            data_peserta.forEach(element => {
                container_peserta.appendChild(elementPeserta(element, "peserta"))
            });

            data_peserta_quiz.forEach(element => {
                container_peserta_quiz.appendChild(elementPeserta(element, "peserta_quiz"))
                
            })

            data_peserta_quiz.forEach(element=>{
                listPeserta.appendChild(listPesertaElement(element))
            })

        })
        .catch(function (error) {

        })
}

function addToKuis(id) {
    axios.post(baseUrl + "api/quiz/add/peserta", { ids: id, kode_kuis: path[path.length - 1] })
        .then((response) => {
            console.log(response);
            getPeserta();
        })
        .catch((error) => {
            console.log(error);
        })
}

function removeToKuis(id) {
    axios.post(baseUrl + "api/quiz/delete/peserta", { ids: id })
        .then((response) => {
            getPeserta();
        })
        .catch((error) => {

        });
}

function elementPeserta(data, type) {
    var container = document.createElement("li");
    container.classList.add("list-group-item", "d-flex", "my-1", "justify-content-between", "align-items-baseline", "rounded-4");

    var nama_container = document.createElement("div")
    nama_container.classList.add("ms-2", "me-auto");

    var nama_text_div = document.createElement("div");
    nama_text_div.classList.add("fw-bold");


    // var tombol = document.createElement("button");
    // tombol.classList.add("btn","btn-primary","rounded-5");
    // tombol.setAttribute("data-peserta",data.id);
    var checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.value = `${data.id}`;
    checkbox.classList.add("form-check-input");
    if (type == "peserta_quiz") {
        checkbox.classList.add("hapus-checkbox")
        checkbox.value = `${data.id}`;
        nama_text_div.innerHTML = data.peserta.nama;
        // var icon = document.createElement("i");
        // icon.classList.add("fa-solid","fa-circle-minus","hapus_peserta_kuis");
        // tombol.classList.add("hapus_peserta_kuis");
    } else {
        checkbox.classList.add("tambah-checkbox");
        nama_text_div.innerHTML = data.nama;
        // var icon = document.createElement("i");
        // icon.classList.add("fa-solid","fa-circle-plus","tambah_peserta_kuis");
        // tombol.classList.add("tambah_peserta_kuis");
    }
    // icon.setAttribute("data-peserta",data.id)
    // tombol.appendChild(icon);
    nama_container.appendChild(nama_text_div);
    container.appendChild(nama_container);
    container.appendChild(checkbox)

    return container;
}

function listPesertaElement(data) {
    console.log(data.peserta.nama)
    var listItem = document.createElement('li');
    listItem.className = 'list-group-item d-flex my-1 justify-content-between align-items-start rounded-4';

    // Membuat elemen <div> untuk nama dengan kelas "ms-2 me-auto"
    var nameDiv = document.createElement('div');
    nameDiv.className = 'ms-2 me-auto';
    var nameStrong = document.createElement('div');
    nameStrong.className = 'fw-bold';
    nameStrong.innerHTML = `${data.peserta.nama}`;
    nameDiv.appendChild(nameStrong);

    // Membuat elemen <span> untuk badge dengan kelas "badge bg-danger rounded-pill"
    // var badgeSpan = document.createElement('span');
    // badgeSpan.className = 'badge bg-danger rounded-pill';
    // badgeSpan.innerHTML = '0/3';

    // Menyusun elemen-elemen yang sudah dibuat
    listItem.appendChild(nameDiv);
    // listItem.appendChild(badgeSpan);

    // Menambahkan elemen <li> ke dalam elemen tujuan (misalnya, elemen dengan ID "list-container")


    return listItem;

}








