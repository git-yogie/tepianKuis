
var modal = new bootstrap.Modal("#form_edit");
var editQuizButton = document.getElementById("edit_kuis");
var form = document.getElementById("form_buat_kuis");
const cardContainer = document.getElementById("cardContainer");
const inputCari = document.getElementById("cariKuis");


const baseurl = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
const idKuis = document.getElementById("idIn").value

editQuizButton.addEventListener("click", function (e) {
    modal.show()
})

form.addEventListener("submit", function (e) {
    e.preventDefault()
    var data = new FormData(this);
    axios.post(`${baseurl}/api/quiz/edit/{id}`, data)
        .then(function (response) {
            form.reset();
            modal.hide();
            Toastify({
                text: "Berhasil menyimpan!",
                duration: 3000
            }).showToast();
            window.location.reload();
        })
        .catch(function (error) {
            validateFormTambah(error.response.data.errors);
        })

})

function validateFormTambah(error) {
    var arrayId = ["mata_pelajaran", "judul_kuis"];

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
