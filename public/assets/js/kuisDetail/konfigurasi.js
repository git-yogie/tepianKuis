

var waktu_mulai_el = document.getElementById("waktu_mulai");
var waktu_berakhir_el = document.getElementById("waktu_berakhir");
var waktu_el = document.getElementById("waktu");
var bisaUlang = document.getElementById("bisaUlang");
var tampilkanPoin = document.getElementById("tampilkanPoin");

const tombolSimpan = document.getElementById("simpan_konfigurasi");
const id_kuis = document.getElementById("id_kuis").value;

const datePicker_waktuMulai = flatpickr(waktu_mulai_el, {
    enableTime: true,
    time_24hr: true,
    dateFormat: "Y-m-d H:i",
});

const datePicker_waktuBerakhir = flatpickr(waktu_berakhir_el, {
    enabledTime: true,
    time_24hr: true,
    dateFormat: "Y-m-d H:i"
});

const timePicker_lamaWaktu = flatpickr(waktu_el, {
    enableTime: true,
    enableSeconds: true,
    time_24hr: true,
    dateFormat: "H:i:S",
    noCalendar: true
});


onLoadKonfigurasi()
function onLoadKonfigurasi(){
    axios.get(`${baseUrl}api/quiz/config/get/${id_kuis}`)
    .then(function(response){
        console.log(response.data)
        if(response.data){
            const data_val= response.data;
            if(data_val.waktu_mulai != null){
                datePicker_waktuMulai.setDate(data_val.waktu_mulai)
            }
            if(data_val.waktu_berakhir != null){
                datePicker_waktuMulai.setDate(data_val.waktu_berakhir)
            }
            if(data_val.waktu != null){
                timePicker_lamaWaktu.setDate(data_val.waktu);
            }
            if(data_val.ulangi != null){
                bisaUlang.checked = data_val.ulangi;
            }
            if(data_val.tampilkanPoin != null){
                tampilkanPoin.checked = data_val.tampilkanPoin;
            }

        }
    })
    .catch(function(error){
        console.log(error)
    });
}






tombolSimpan.addEventListener("click", function (e) {

    const waktuMulai = new Date(waktu_mulai_el.value);
    const waktuBerakhir = new Date(waktu_berakhir_el.value);

    var data = {
        waktu_mulai: waktu_mulai_el.value,
        waktu_berakhir: waktu_berakhir_el.value,
        waktu: waktu_el.value,
        ulangi: bisaUlang.checked ? true : false,
        tampilkanPoin: tampilkanPoin.checked ? true : false
    }

    

    axios.post(baseUrl + "api/quiz/update/config/" + id_kuis, data)
        .then((response) => {
            console.log(response);
            Toastify({
                text: "Berhasil mengupdate konfigurasi!",
                duration: 3000
            }).showToast();
        })
        .catch((error) => {

        })

})