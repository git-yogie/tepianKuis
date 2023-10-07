
// element html
const moda_profil = new bootstrap.Modal("#modal-profile");
const api_key_button = document.getElementById("api_key_button");
const form_profile = document.getElementById("form_profile");

// input
const api_key = document.getElementById("api_key");
const end_point = document.getElementById("end_point");


// baseurle type of protocol + hostname + post(is needed);
const baseurl = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
// variable data (key)
const id_user = document.getElementById("id_user").value;


// header

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

const Prompt = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-danger mx-3',
        cancelButton: 'btn btn-success'
    },
    buttonsStyling: false
})


// listener
form_profile.addEventListener("submit",function(e){
    e.preventDefault();
    var formData = new FormData(form_profile);
    axios.post(`${baseurl}/dashboard/profile/update`,formData)
    .then(function(response){
        console.log(response)
        toastFire("success","Berhasil update profile!");
        window.location.reload();
    })
    .catch(function(error){
        console.log(error);
        toastFire("error","<b>Gagal</b> terjadi kesalahan!");
    })

})



api_key_button.addEventListener("click", function (e) {
    Prompt.fire({
        title: 'Perbarui api key!',
        text: "Seluruh aplikasi atau web yang menggunakan tepian kuis akan terdampak",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Perbarui',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            refreshToken();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })

})


// function
function toastFire(icon,message){
    Toast.fire({
        icon: icon,
        title: message
    })
}

function refreshToken() {
    axios.get(`${baseurl}/dashboard/refreshtoken/${id_user}`)
        .then(function (response) {
            console.log(response.data.new_token);
            api_key.innerHTML = response.data.new_token;
            end_point.innerHTML = `${baseurl}/api/${response.data.new_token}/kuis/`
            toastFire("success","Berhasil merubah api key!");
        })
        .catch(function (err) {
            toastFire("error",`<b>Gagal </b> ${err.response.statusText}`)
        });
}








