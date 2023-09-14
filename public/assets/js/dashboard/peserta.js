
var tablePeserta = document.getElementById("table-data-peserta");



// ------------------form tambah area ----------------------------
var formTambah = document.getElementById("tambahPesertaForm")
const modalTambah = new bootstrap.Modal(document.getElementById("form-peserta"));
const modalTitle = document.getElementById("modalTitle")
const modalButton = document.getElementById("tambah-peserta");
const modalEditButton = document.getElementById("edit-peserta");

const id = document.getElementById("idIn")

// document.addEventListener("DOMContentLoaded", populateData())
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

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

const deletePrompt = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-danger mx-3',
        cancelButton: 'btn btn-success'
    },
    buttonsStyling: false
})

// ------------------form tambah area ----------------------------
document.getElementById("form-peserta").addEventListener("hidden.bs.modal", function () {
    formTambah.reset();
    id.value = null
    modalTitle.innerHTML = "Tambah data Peserta"
    modalButton.classList.remove("d-none");
    modalEditButton.classList.add("d-none");
    clearValidate()
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
            Toast.fire({
                icon: 'error',
                title: 'Gagal mengambil data!'
            })
            modalTambah.hide();
        })
}


modalEditButton.addEventListener("click", (e) => {
    e.preventDefault()
    var formData = new FormData(formTambah);
    axios.post("/api/peserta/edit/" + id.value, formData)
        .then(function (response) {
            modalTambah.hide();
            formTambah.reset();
            id.value = null
            Toast.fire({
                icon: 'success',
                title: 'Berhasil mengubah data!'
            })
            dataTable.ajax.reload();
        })
        .catch(function (error) {
            Toast.fire({
                icon: 'error',
                title: 'Gagal mengubah data!'
            })
            validateFormTambah(error.response.data.errors);
        })



})

modalButton.addEventListener("click", (e) => {
    e.preventDefault();
    var formData = new FormData(formTambah);

    axios.post("/api/peserta", formData)
        .then(function (response) {
            modalTambah.hide();
            formTambah.reset();
            Toast.fire({
                icon: 'success',
                title: 'Berhasil ditambahkan!'
            })
            dataTable.ajax.reload();

        })
        .catch(function (error) {
            Toast.fire({
                icon: 'error',
                title: 'Gagal ditambahkan!'
            })
            validateFormTambah(error.response.data.errors);
        })
        .then(function () {

        });

})

function deleteData(id) {
    deletePrompt.fire({
        title: 'Apakah anda yakin!',
        text: "data yang dihapus tidak akan bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete("/api/peserta/" + id)
                .then(function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil menghapus!'
                    })
                    dataTable.ajax.reload();
                })
                .catch(function (error) {

                })
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })

}


// formTambah.addEventListener("submit", function (e) {
//     e.preventDefault();
//     var form = new FormData(this);

//     console.log(id.value);
//     if (id.value != null) {
//         axios.post("/api/peserta/edit/" + id.value, form)
//             .then(function (response) {
//                 modalTambah.hide();
//                 formTambah.reset();
//                 id.value = null
//                 Toastify({
//                     text: "Berhasil di ubah!",
//                     duration: 3000
//                 }).showToast();
//                 dataTable.ajax.reload();
//             })
//             .catch(function (error) {
//                 validateFormTambah(error.response.data.errors);
//             })
//     } else {
//         axios.post("/api/peserta", form)
//             .then(function (response) {
//                 modalTambah.hide();
//                 formTambah.reset();
//                 Toastify({
//                     text: "Peserta Baru Ditambahkan!",
//                     duration: 3000
//                 }).showToast();
//                 dataTable.ajax.reload();

//             })
//             .catch(function (error) {
//                 validateFormTambah(error.response.data.errors);
//             })
//             .then(function () {

//             });
//     }



// });


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


function clearValidate() {
    var arrayId = ["nama", "nis", "email", "kelas"];
    arrayId.forEach(element => {
        let elemet = document.getElementById(element);
        let field = document.getElementById(element + "_field");
        elemet.classList.remove("is-invalid");
        field.classList.remove("invalid-feedback");
        elemet.classList.remove("is-valid");
        field.classList.remove("valid-feedback");
        field.innerHTML = "";
    })
}




































