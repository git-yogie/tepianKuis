


var tablePeserta = document.getElementById("table-data-peserta");



// ------------------form tambah area ----------------------------
var formTambah = document.getElementById("tambahPesertaForm")
const modalTambah = new bootstrap.Modal(document.getElementById("form-peserta"));
const modalTitle = document.getElementById("modalTitle")
const modalButton = document.getElementById("tambah-peserta");
const modalEditButton = document.getElementById("edit-peserta");


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
            
            <button class="btn btn-success btn-edit" onclick=editData("${data}")><i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-danger btn-delete" onclick=deleteData("${data}")><i class="bi bi-trash"></i></button>
            
            `}
        },

    ]
});

// ------------------form tambah area ----------------------------
document.getElementById("form-peserta").addEventListener("hidden.bs.modal",function(){
    formTambah.reset();
    modalTitle.innerHTML = "Tambah data Peserta"
    modalButton.classList.remove("d-none");
    modalEditButton.classList.add("d-none");
})

function editData(id) {
    modalTambah.show()
    modalTitle.innerHTML = "Ubah data Peserta"
    modalButton.classList.add("d-none");
    modalEditButton.classList.remove("d-none");
    axios.get("/api/peserta/" + id)
        .then(function (response) {
            let data = response.data;
            let nama = document.getElementById("nama");
            let email = document.getElementById("email");
            let kelas = document.getElementById("kelas");
            let nis = document.getElementById("nis");
            let id = document.getElementById("idIn");

            nama.value = data.nama;
            email.value = data.email;
            kelas.value = data.kelas;
            nis.value = data.nis;
            id.value = data.id

        })
        .catch(function (error) {

        })
}



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
    var id =document.getElementById("idIn")
    if(id.value != null){
        axios.post("/api/peserta/edit/"+id.value,form)
        .then(function(response){
            modalTambah.hide();
            formTambah.reset();
            Toastify({
                text: "Berhasil di ubah!",
                duration: 3000
            }).showToast();
            dataTable.ajax.reload();
        })
        .catch(function(error){
            validateFormTambah(error.response.data.errors);
        })
    }else{
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
    }
   


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


































