
$(document).ready(function () {
    var toastContainer = $('#toastContainer');
    var daftarForm = $("#form-daftar");
    daftarForm.on("submit", function (e) {
        e.preventDefault();
        lazyLoader("#daftarButton", true, "Daftar", "Daftar");

        var formData = new FormData(this)

        axios.post("/api/signup", formData)
            .then(function (response) {
                console.log(response.data);
                if (response.data.status == false) {
                    showToast(toastContainer, `<b>Gagal</b> ${response.data.message}`, 'error')
                } else {
                    showToast(toastContainer, "<b>Sukses</b> Berhasil Masuk!", 'success')
                }

                lazyLoader("#signInBtn", false, "Masuk", "Masuk");
            })
            .catch(function (error) {
                console.log(error)
                console.log("ok")
                showToast(toastContainer, "Error <b>" + error.response.status + "</b> " + error.response.statusText, 'error')
                lazyLoader("#signInBtn", false, "Masuk", "Masuk");
            })

    });



})