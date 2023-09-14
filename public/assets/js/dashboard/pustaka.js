
document.addEventListener("DOMContentLoaded", function () {
    var modal = new bootstrap.Modal(this.getElementById("form_create_quiz"));
    var create_quiz_button = this.getElementById("button_buat_kuis");
    var form = this.getElementById("form_buat_kuis");
    const cardContainer = this.getElementById("cardContainer");
 


    // protocol + base Host
    const baseHost = window.location.host;
    const protocol = window.location.protocol + "//";
    const baseUrl = protocol + baseHost;
    // 

    this.getElementById("form_create_quiz").addEventListener("hidden.bs.modal", function () {
        form.reset();
        document.getElementById("file_name").value = "";
        document.getElementById("image_preview").setAttribute("src", protocol + baseHost + "/images/quiz-picture.png")
    });

    getQuiz()


    function getQuiz() {
        axios.get(baseUrl + "/api/quiz")
            .then(function (response) {
                populateCard(response.data)
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    

    // menambahkan kuis baru;
    form.addEventListener("submit", function (e) {
        e.preventDefault()
        var data = new FormData(this);
        axios.post(protocol + baseHost + "/api/quiz", data)
            .then(function (response) {
                form.reset();
                modal.hide();
                Toastify({
                    text: "Berhasil membuat kuis baru!",
                    duration: 3000
                }).showToast();
                getQuiz();
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

    function populateCard(data) {
        cardContainer.innerHTML = "";

        for (const key in data) {
            if (data.hasOwnProperty.call(data, key)) {
                const element = data[key];
                var card = createKuisCard(
                    element.nama,
                    element.mata_pelajaran,
                    element.tingkatan,
                    element.kuis_code,
                    element.banner,
                    element.soal_count
                );
                cardContainer.appendChild(card);
            }
        }

    }

    function createKuisCard(nama, mata_pelajaran, tingkatan, kuis_code, banner,soal_count) {
        const colDiv = document.createElement('div');
        colDiv.classList.add('col-lg-4');

        const link = document.createElement('a');
        link.href = baseUrl+"/pustaka/kuis/" + kuis_code;
        link.classList.add('card', 'rounded-4', 'kuis-item');

        const cardDiv = document.createElement('div');
        cardDiv.classList.add('card-body', 'p-3');

        const img = document.createElement('img');
        if(banner != null){
            img.src = baseUrl + "/files/" + banner;
        }else{
            img.src = baseUrl +"/images/quiz-picture.png"
        }
        img.classList.add('card-img', 'rounded-4');
        img.alt = nama;
 
        const innerDiv = document.createElement('div');
        innerDiv.classList.add('p-2');

        const badgeKuis = document.createElement('span');
        badgeKuis.classList.add('badge', 'rounded-pill', 'text-bg-primary');
        badgeKuis.textContent = "Kuis";

        const badgeStatus = document.createElement('span');
        badgeStatus.classList.add('badge', 'rounded-pill', 'text-bg-success', "mx-2");
        badgeStatus.textContent = "active";

        const heading = document.createElement('h5');
        heading.classList.add('mt-2', 'ml-1');
        heading.textContent = nama;

        const paragraph = document.createElement('p');
        paragraph.classList.add('text-muted');
        paragraph.style.fontSize = "12px";
        paragraph.textContent = mata_pelajaran + ` \u2022 20 Peserta \u2022 ${soal_count} Soal`;

        // Append elements
        innerDiv.appendChild(badgeKuis);
        innerDiv.appendChild(badgeStatus);
        innerDiv.appendChild(heading);
        innerDiv.appendChild(paragraph);

        cardDiv.appendChild(img);
        cardDiv.appendChild(innerDiv);

        link.appendChild(cardDiv);
        colDiv.appendChild(link);

        return colDiv;
    }




})