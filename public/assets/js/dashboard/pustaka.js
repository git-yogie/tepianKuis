
document.addEventListener("DOMContentLoaded", function () {
    var modal = new bootstrap.Modal(this.getElementById("form_create_quiz"));
    var create_quiz_button = this.getElementById("button_buat_kuis");
    var form = this.getElementById("form_buat_kuis");
   
    // protocol + base Host
    const baseHost = window.location.host;
    const protocol = window.location.protocol +"//";
// 
    
    this.getElementById("form_create_quiz").addEventListener("hidden.bs.modal",function(){
        form.reset();
        document.getElementById("file_name").value = "";
        document.getElementById("image_preview").setAttribute("src",protocol+baseHost+"/images/quiz-picture.png")
    });
// menambahkan kuis baru;
    form.addEventListener("submit", function (e) {
        e.preventDefault()
        var data = new FormData(this);
        axios.post(protocol+baseHost+"/api/quiz", data)
            .then(function (response) {
                form.reset();
                modal.hide();
                Toastify({
                    text: "Berhasil membuat kuis baru!",
                    duration: 3000
                }).showToast();
            })
            .catch(function (error) {
                validateFormTambah(error.response.data.errors);
            })

    })


    create_quiz_button.addEventListener("click", function () {
        modal.show();
    })

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
    

})