


var tablePeserta = document.getElementById("table-data-peserta");



// ------------------form tambah area ----------------------------
var formTambah = document.getElementById("tambahPesertaForm")
const modalTambah = new bootstrap.Modal(document.getElementById("form-peserta"));
document.addEventListener("DOMContentLoaded", populateData())
const buttonsDelete = document.querySelectorAll('.btn-delete');

const dataTable = $('#table-data-peserta').DataTable({
    ajax: {
        url: '/api/peserta',
        dataSrc: ''
    },
    columns: [
        {
            data: 'id',
            render: function (data) {
                return `<input type="checkbox" id="myCheckbox" name="myCheckbox" value="${data}">`
            }
        },
        { data: "nama" },
        { data: "nis" },
        { data: "kelas" },
        { data: "email" },
        {
            data: "id",
            render: function (data) {
                return `
            
            <button class="btn btn-success btn-edit" "${data}"><i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-danger btn-delete" onclick=deleteData("${data}")><i class="bi bi-trash"></i></button>
            
            `}
        },

    ]
});

function deleteData(id) {
    axios.delete("/api/peserta/" + id)
        .then(function (response) {
            Toastify({
                text: "Selesai dihapus!!",
                duration: 3000
            }).showToast();
            dataTable.ajax.reload();
        })
        .catch(function (error) {

        })
}



function populateData() {
    axios.get("/api/peserta")
        .then(function (response) {


        })
        .catch(function (error) {

        })
}

formTambah.addEventListener("submit", function (e) {
    e.preventDefault();
    var form = new FormData(this);

    axios.post("/api/peserta", form)
        .then(function (response) {
            modalTambah.hide();
            formTambah.reset();
            Toastify({
                text: "Peserta Baru Ditambahkan!",
                duration: 3000
            }).showToast();
            dataTable.ajax.reload();

        })
        .catch(function (error) {
            validateFormTambah(error.response.data.errors);
        })
        .then(function () {

        });


});


// digunakan untuk memvalidasi form
// dengan data error yang berasal dari output Route APi
function validateFormTambah(error) {
    var arrayId = ["nama", "nis", "email", "kelas"];

    arrayId.forEach(element => {
        let elemet = document.getElementById(element);
        let field = document.getElementById(element + "_field");
        if (element in error) {


            elemet.classList.add("is-invalid");
            field.classList.add("invalid-feedback");
            field.innerHTML = error[element];
        } else {

            elemet.classList.remove("is-invalid");
            field.classList.remove("invalid-feedback");
            elemet.classList.add("is-valid");
            field.classList.add("valid-feedback");
            field.innerHTML = "Sudah benar!";

        }

    });

}


































