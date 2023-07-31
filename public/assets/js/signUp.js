
$(document).ready(function () {

    var toastContainer2 = $('#toastContainer2');
    var daftarForm = $("#form-daftar");
    var masuk = new bootstrap.Modal(document.getElementById('masuk'));
    daftarForm.on("submit", function (e) {
        e.preventDefault();
        lazyLoader("#daftarButton", true, "Daftar", "Daftar");

        var formData = new FormData(this)

        axios.post("/api/signup", formData)
            .then(function (response) {
                console.log(response.data);
                if (response.data.status == false) {
                    showToast(toastContainer2, `<b>Gagal</b> ${response.data.message}`, 'error')
                } else {
                    showToast(toastContainer2, "<b>Sukses</b> Berhasil Masuk Daftar Silahkan Masuk", 'success')
                    masuk.show()
                }

                lazyLoader("#daftarButton", false, "Masuk", "Masuk");
            })
            .catch(function (error) {
                console.log(error.response.data)
                console.log("ok")
                showToast(toastContainer2, "<b> Error </b>" + error.response.data.message + "", 'error')
                lazyLoader("#daftarButton", false, "Masuk", "Masuk");
            })

    });



})