
document.addEventListener("DOMContentLoaded", (e) => {

    const soal_render = document.getElementById("soal-render");
    const jawaban = document.getElementById("jawaban")
    const nama_kuis = document.getElementById("nama_kuis");
    const id_user = document.getElementById("id_user");

    var params = new URLSearchParams(window.location.search);
    var url = window.location.href.split("/");
    const code = params.get("code");

    let index_soal = 0;
    const endPoint = window.location.protocol + "//" + window.location.host + "/api/soal/" + url[url.length - 1];
    const baseUrl = window.location.protocol + "//" + window.location.host + "/api/";
    const no_soal = document.getElementById("no_soal");
    const soalTitle = document.getElementById("nomerSoal");
    const tombolSimpan = document.getElementById("selesai");
    const modalSelesai = new bootstrap.Modal('#modal_waktuHabis');
    const konfirmasi_selesai = document.getElementById("konfirmasi_selesai");

    const modalSelesaiQuiz = new bootstrap.Modal("#modal_selesai")



    const jawabanStorage = localStorage.getItem("jawaban_user_" + url[url.length - 1])



    const idPeserta = document.getElementById("id_user");
    console.log(idPeserta.value)
    data = {};
    var jawabanUser = [];
    if (jawabanStorage != null) {
        jawabanUser = JSON.parse(jawabanStorage);
        console.log(jawabanUser);

    }

    tombolSimpan.addEventListener("click", () => {
        modalSelesaiQuiz.show();
    });

    konfirmasi_selesai.addEventListener("click", () => {
        finishQuiz();
    })

    function simpanJawabanUser() {
        const id_user = document.getElementById("id_user");
        var id = id_user.value;
        var kode_kuis = url[url.length - 1];

        let poin = 0;
        let jumlahBenar = 0;
        let jumlahPoin = 0;
        let persentase = 0;

        data.forEach(soal => {
            jumlahPoin += Number(soal.poin);
        })


        jawabanUser.forEach(element => {
            if (element.hasil) {
                jumlahBenar++
                poin += Number(element.data.poin)
            }
        });

        if (poin !== 0) {
            persentase = (poin / jumlahPoin) * 100;
            // bila persentasi memiliki desimal 0
            if (persentase % 1 === 0) {
                persentase = persentase.toFixed(0);
            }else{
                persentase = persentase.toFixed(2);
            }
        }



        localStorage.setItem("jawaban_user_" + url[url.length - 1], JSON.stringify(jawabanUser));
        const end_time = localStorage.getItem("end_time_" + url[url.length - 1]);
        const start_time = localStorage.getItem("start_time_" + url[url.length - 1]);
        const now = new Date();
        const startTimeStamp = new Date(start_time);

        const waktu_mengerjakan = now.getTime() - startTimeStamp.getTime();

        var hasil = {
            jumlahBenar: jumlahBenar,
            nilai: persentase,
            poin: poin,
            jumlahPoin: jumlahPoin,
            jawaban_user: jawabanUser,
            waktu_mengerjakan: waktu_mengerjakan,
        }

        localStorage.removeItem("end_time_" + url[url.length - 1]);
        localStorage.removeItem("start_time_" + url[url.length - 1]);
        localStorage.removeItem("jawaban_user_" + url[url.length - 1]);


        var send = JSON.stringify(hasil);
        console.log(send);
        axios.post(`${baseUrl}quiz/save/jawaban/${id}`,{"result":send})
        .then(function(response){
            console.log(response)
            window.location = window.location.protocol + "//" + window.location.host + "/cbt/hasil/"+url[url.length - 1]+"/"+id;
        })
        .catch(function(err){

        })
    }
    const self = this
    axios.get(endPoint)

        .then((result) => {

            self.data = result.data.data;
            // mengacak soal
            data.sort(() => Math.random() - 0.5);

            axios.get(baseUrl + "quiz/" + url[url.length - 1])
                .then((response) => {
                    var quiz_data = response.data;
                    nama_kuis.innerHTML = quiz_data.nama
                    console.log(quiz_data.konfigurasi);
                    if(quiz_data.konfigurasi != "{}"){
                        var konfigurasi = JSON.parse(quiz_data.konfigurasi);
                        startCountdownTimer(konfigurasi.waktu);
                    }else{
                        if(localStorage.getItem("start_time_" + url[url.length - 1]) == null){
                            localStorage.setItem("start_time_" + url[url.length - 1], new Date());
                        }
                    }
                })
                .catch((error) => {

                })

            setNoSoal(data);
            setSoal("soal_" + (index_soal + 1) + "_" + data[index_soal].id, data[index_soal]);
            noSoalReset(data)
            soalTitle.innerHTML = "Nomor Soal " + index_soal
            document.addEventListener("click", (e) => {
                var target = e.target;
                if (target.classList.contains("tombol-soal")) {
                    var target_id = target.id;
                    var params = target_id.split("_")
                    getUserAnswer(data[index_soal - 1]);
                    noSoalReset(data)
                    setSoal(target_id, data[params[1] - 1])
                }

                if (target.classList.contains("selanjutnya")) {
                    if (index_soal < data.length) {
                        getUserAnswer(data[index_soal - 1]);
                        noSoalReset(data);
                        index_soal++
                        nextSoal(data[index_soal - 1]);
                    }
                }

                if (target.classList.contains("sebelumnya")) {
                    if (index_soal > 1) {

                        getUserAnswer(data[index_soal - 1]);
                        index_soal--
                        noSoalReset(data);
                        nextSoal(data[index_soal - 1]);

                    }
                }
                if (target.classList.contains("jawaban-soal")) {
                    console.log(target)
                }
                soalTitle.innerHTML = "Nomor Soal " + index_soal


            })
        }).catch((err) => {
            console.log(err)
            window.location.reload;
        });


    function updateDisplay(hours, minutes, seconds) {
        const element = document.getElementById("timerText");
        if (seconds < 10) {
            seconds = "0" + seconds
        }
        if (minutes < 10) {
            minutes = "0" + minutes
        }
        if (hours < 10) {
            hours = "0" + hours
        }
        element.innerHTML = `${hours} : ${minutes} : ${seconds}`
    }

    function startCountdownTimer(time) {

        const parts = time.split(':');
        if (parts.length !== 3) {
            throw new Error('Input format should be HH:mm:ss');
        }

        const hours = parseInt(parts[0], 10);
        const minutes = parseInt(parts[1], 10);
        const seconds = parseInt(parts[2], 10);
        var totalSeconds = hours * 3600 + minutes * 60 + seconds;
        var endTime = localStorage.getItem("end_time_" + url[url.length - 1]);

        if (endTime != null) {
            var waktuberakhir = new Date(endTime);
            var now = new Date();
            var selisih = waktuberakhir.getTime() - now.getTime();
            totalSeconds = Math.floor(selisih / 1000);
            console.log(totalSeconds);
            if (totalSeconds < 0) {
                waktuHabis();
                return false;
            }

        } else {
            const now = new Date();
            const end = new Date();
            end.setSeconds(end.getSeconds() + totalSeconds);

            localStorage.setItem("start_time_" + url[url.length - 1], now);
            localStorage.setItem("end_time_" + url[url.length - 1], end)
        }

        var intervalId = setInterval(function () {
            var hours = Math.floor(totalSeconds / 3600);
            var minutes = Math.floor((totalSeconds % 3600) / 60);
            var seconds = totalSeconds % 60;

            updateDisplay(hours, minutes, seconds);
            totalSeconds--;
            if (totalSeconds < 0) {
                clearInterval(intervalId);
                finishQuiz();
            }
        }, 1000);

    }


    function setNoSoal(data) {
        var i = 0
        data.forEach(element => {
            no_soal.appendChild(noSoal(i + 1, element.id));
            i++
        });
    }
    function noSoalReset(data) {
        var i = 1
        data.forEach(element => {
            let button = document.getElementById("soal_" + i + "_" + element.id);
            let find = jawabanUser.find(item => item.id === element.id);
            button.classList.replace("btn-primary", "btn-outline-primary");
            if (find) {
                button.classList.replace("btn-outline-primary", "btn-success")
            }
            i++
        });

    }


    function setSoal(targetId, data) {
        var params = targetId.split("_")
        index_soal = params[1];


        console.log(soalTitle.innerText = "Nomer Soal " + index_soal);
        var soal = JSON.parse(data.soal_data)
        soal_render.innerHTML = soal.pertanyaan

        document.getElementById(targetId).classList.replace("btn-outline-primary", "btn-primary")

        renderJawaban(data);
    }

    function nextSoal(data) {
        const targetId = "soal_" + (index_soal) + "_" + data.id;
        var soal = JSON.parse(data.soal_data)
        soal_render.innerHTML = soal.pertanyaan
        document.getElementById(targetId).classList.replace("btn-outline-primary", "btn-primary")
        renderJawaban(data);

    }
    function renderJawaban(data) {
        var soal = JSON.parse(data.soal_data)
        switch (data.jenis_soal) {
            case "pilihanGanda":
                renderPilihanGanda(data, soal.pilihan)
                break;
            case "isianSingkat":
                renderIsianSingkat(data);
                break;
            default:
                break;
        }

    }

    function noSoal(number, id) {

        var button = document.createElement("button");
        button.classList.add("col-auto", "btn", "btn-outline-primary", "rounded-1", "m-1", "tombol-soal");
        button.setAttribute("type", "button");
        button.setAttribute("id", "soal_" + number + "_" + id);
        button.textContent = number;

        return button;

    }

    function renderPilihanGanda(data, pilihan) {

        const abj = ["A", "B", "C", "D", "E", "F"]
        jawaban.innerHTML = ''
        let saved = jawabanUser.find(item => item.id === data.id);
        console.log(jawabanUser)
        var i = 0;
        pilihan.forEach(function (option) {
            var optionDiv = document.createElement('div');
            // optionDiv.classList.add('col-md-12', 'form-check', 'd-flex', 'align-items-center', 'border');
            optionDiv.classList.add('form-check', 'd-flex', 'align-items-baseline', 'border', "p-3", "outer", "rounded-4", "m-1");

            var radioInput = document.createElement('input');2
            var divClear = document.createElement("div");
            var soal = document.createElement("p")

            soal.classList.add("mx-4", "text-center", "align-self-center");
            soal.style = "margin-top:auto";
            soal.innerHTML = option.text;

            divClear.appendChild(soal);

            radioInput.classList.add("jawaban-soal", "btn-check");
            radioInput.type = 'radio';
            radioInput.name = data.id;
            radioInput.id = option.id;// Anda perlu memberikan id yang berbeda untuk setiap radio input

            var label = document.createElement('label');
            label.classList.add('btn', 'btn-outline-primary', "pilihan");
            label.htmlFor = option.id; // Sesuaikan dengan id radio input yang sesuai
            label.innerHTML = abj[i];
            // label.innerHTML = option.text;

            if (saved) {
                if (saved.jawaban == option.id) {
                    radioInput.checked = true;
                }
            }


            optionDiv.appendChild(radioInput);
            optionDiv.appendChild(label);
            optionDiv.appendChild(divClear);


            jawaban.appendChild(optionDiv);
            radioInput.addEventListener("change", (e) => {
                getUserAnswer(data);
            })
            i++;
        });

    }
    function renderIsianSingkat(data) {
        jawaban.innerHTML = '';

        let saved = jawabanUser.find(item => item.id === data.id);

        var container = document.createElement("div")
        container.classList.add("mb-3")
        var input = document.createElement("input");
        var label = document.createElement("label");

        input.classList.add("form-control", "jawaban-soal");
        input.setAttribute("type", "text");
        input.id = data.id;
        input.placeholder = "Jawaban anda";
        input.name = data.id;
        if (saved) {
            input.value = saved.jawaban
        }

        label.setAttribute("for", data.id);
        label.textContent = "Jawaban";

        container.appendChild(label);
        container.appendChild(input);

        jawaban.appendChild(container);

    }
    function getUserAnswer(data) {
        var soal = JSON.parse(data.soal_data)
        switch (data.jenis_soal) {
            case "pilihanGanda":
                const checkedRadioButton = [...document.querySelectorAll('input[name="' + data.id + '"]:checked')][0];
                if (checkedRadioButton) {
                    var hasil = soal.pilihan.find(item => item.id === checkedRadioButton.id).benar;
                    // var saved = jawabanUser.find(item => item.id === data.id);
                    var indexOfJawaban = jawabanUser.findIndex(item => item.id === data.id);
                    if (indexOfJawaban != -1) {
                        jawabanUser[indexOfJawaban].jawaban = checkedRadioButton.id;
                        jawabanUser[indexOfJawaban].hasil = hasil;
                    } else {
                        jawabanUser.push({
                            id: data.id,
                            data: { id: data.id, poin: data.poin },
                            // soal: soal,
                            jawaban: checkedRadioButton.id,
                            hasil: hasil
                        });
                        localStorage.setItem("jawaban_user_" + url[url.length - 1], JSON.stringify(jawabanUser));
                    }
                }
                break;
            case "isianSingkat":
                var input = document.getElementById(data.id);
                var hasil = soal.jawaban == input.value ? true : false;

                if (input.value.length > 0) {
                    var indexOfJawaban = jawabanUser.findIndex(item => item.id === data.id);
                    if (indexOfJawaban === -1) {
                        jawabanUser.push({
                            id: data.id,
                            data: data,
                            soal: soal,
                            jawaban: input.value,
                            hasil: hasil,
                        })
                    } else {
                        jawabanUser[indexOfJawaban].jawaban = input.value;
                    }
                }
                break;
            default:
                break;
        }

    }
    function checkIfAnswered(id) {
        var Aw = jawabanUser.find(item => item.id === id)
        if (Aw) {
            return true;
        } else {
            return false;
        }
    }

    function finishQuiz() {
        simpanJawabanUser();
    }

    function waktuHabis() {
        // finishQuiz()

        modalSelesai.show();
        // console.log(waktuHabis)
    }

})
