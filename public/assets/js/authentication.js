

$(document).ready(function () {
    var toastContainer = $('#toastContainer'); 
    var formSignIn = $("#signInForm")
    formSignIn.on("submit", function (e) {
        e.preventDefault();
        lazyLoader("#signInBtn", true, "Masuk", "Masuk");
        
        var formData = new FormData(this)


        axios.post("/api/authenticate", formData)
            .then(function (response) {
                console.log(response.data);
                if(response.data.status == false){
                    showToast(toastContainer,`<b>Gagal</b> ${response.data.message}`,'error')
                }else{
                    showToast(toastContainer,"<b>Sukses</b> Berhasil Masuk!",'success')
                    window.location.href = "/dashboard"
                }
              
                lazyLoader("#signInBtn", false, "Masuk", "Masuk");
            })
            .catch(function (error) {
                console.log(error)
        
                showToast(toastContainer,"Error <b>"+error.response.status + "</b> "+error.response.statusText,'error')
                lazyLoader("#signInBtn", false, "Masuk", "Masuk");
                if(error.response.status == "419" || error.response.status == 419){
                    showToast(toastContainer,"<b>Reload</b> :anda bisa login kembali setelah ini!. ")
                    location.reloadv
                }
            })

    });


})

