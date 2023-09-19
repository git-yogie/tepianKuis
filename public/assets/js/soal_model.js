
const baseUrl = window.location.protocol + "//" + window.location.host + "/";
const pathname = window.location.pathname.split("/");


function soal(data) {
    var kode_kuis = pathname[pathname.length - 1]
    var soal_data = JSON.parse(data.soal_data);
    var element = null;
    switch (data.jenis_soal) {
        case "pilihanGanda":
            element = pilihanGanda(data, data.soal_data, kode_kuis);
            break;
        case "isianSingkat":
            element = isianSingkat(data, data.soal_data, kode_kuis);
        default:
            break;
    }

    return element;
}


function isianSingkat(data, soal_data, kode_kuis) {
    const soal = JSON.parse(soal_data);
    var cardDiv = document.createElement('div');

    cardDiv.classList.add('card');
    cardDiv.id = `cardSoal_${data.id}`

    // Membuat elemen div dengan class "card-header"
    var headerDiv = document.createElement('div');
    headerDiv.classList.add('card-header', 'd-flex', 'justify-content-between', 'align-items-baseline');
    var buttonContainer = document.createElement("div");
    buttonContainer.classList.add("d-flex", "justify-content-between", "align-items-baseline");

    var titleH6 = document.createElement('h6');
    titleH6.innerHTML = `${data.judul_soal} &bull; ${data.poin} Poin`;

    var editButton = document.createElement('a');
    editButton.classList.add('btn-success', 'btn', 'btn-sm', 'rounded-5', 'px-2');
    editButton.innerHTML = '<i class="fa-solid fa-file-pen me-1"></i>Edit';
    editButton.href = window.location.protocol + "//" + window.location.host + `/pustaka/kuis/editor/edit/${data.jenis_soal}/${kode_kuis}/${data.id}`

    var deleteButton = document.createElement("button");
    deleteButton.classList.add("btn-danger", "btn", "btn-sm", "rounded-5", "px-2", "ms-2");
    deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>'
    deleteButton.addEventListener("click", function () {
        var confirmDelete = confirm("Apakah anda yakin ingin menghapus soal ini?");
        if (confirmDelete) {
            deleteSoal(data.id);
        }
    })

    buttonContainer.appendChild(editButton);
    buttonContainer.appendChild(deleteButton);
    headerDiv.appendChild(titleH6);

    headerDiv.appendChild(buttonContainer);

    var bodyDiv = document.createElement('div');
    bodyDiv.classList.add('card-body');

    cardDiv.appendChild(headerDiv)

    var questionP = document.createElement('p');
    questionP.innerHTML = soal.pertanyaan;

    // Menambahkan teks pertanyaan ke dalam bodyDiv
    bodyDiv.appendChild(questionP);
    var jawabanDiv = document.createElement('div');
    jawabanDiv.classList.add("mt-2");

    var label = document.createElement("label");

    label.setAttribute("for", data.id);

    var input = document.createElement("input");
    input.classList.add("form-control");
    input.setAttribute("type", "text");
    input.setAttribute("name", data.id);
    input.setAttribute("id", data.id);
    input.setAttribute("placeholder", "Jawaban");
    input.setAttribute("disabled", true);
    input.setAttribute("value", soal.jawaban);

    label.textContent = "jawaban";

    jawabanDiv.appendChild(label);
    jawabanDiv.appendChild(input);

    bodyDiv.appendChild(jawabanDiv);

    cardDiv.appendChild(bodyDiv)

    return cardDiv;

}


function pilihanGanda(data, soal_data, kode_kuis) {
    const soal = JSON.parse(soal_data);
    var cardDiv = document.createElement('div');
    cardDiv.classList.add('card');
    cardDiv.id = `cardSoal_${data.id}`

    // Membuat elemen div dengan class "card-header"
    var headerDiv = document.createElement('div');
    headerDiv.classList.add('card-header', 'd-flex', 'justify-content-between', 'align-items-baseline');
    var buttonContainer = document.createElement("div");
    buttonContainer.classList.add("d-flex", "justify-content-between", "align-items-baseline");

    // Membuat elemen h6 untuk judul
    var titleH6 = document.createElement('h6');
    titleH6.innerHTML = `${data.judul_soal} &bull; ${data.poin} Poin`;

    // Membuat elemen button untuk Edit
    var editButton = document.createElement('a');
    editButton.classList.add('btn-success', 'btn', 'btn-sm', 'rounded-5', 'px-2');
    editButton.innerHTML = '<i class="fa-solid fa-file-pen me-1"></i>Edit';
    editButton.href = window.location.protocol + "//" + window.location.host + `/pustaka/kuis/editor/edit/${data.jenis_soal}/${kode_kuis}/${data.id}`

    // in Elemen untuk tombol delete 
    var deleteButton = document.createElement("button");
    deleteButton.classList.add("btn-danger", "btn", "btn-sm", "rounded-5", "px-2", "ms-2");
    deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>'
    deleteButton.addEventListener("click", function () {
        var confirmDelete = confirm("Apakah anda yakin ingin menghapus soal ini?");
        if (confirmDelete) {
            deleteSoal(data.id);
        }
    })

    buttonContainer.appendChild(editButton);
    buttonContainer.appendChild(deleteButton);

    headerDiv.appendChild(titleH6);
    headerDiv.appendChild(buttonContainer);

    // Menambahkan headerDiv ke dalam cardDiv
    cardDiv.appendChild(headerDiv);

    // Membuat elemen div dengan class "card-body"
    var bodyDiv = document.createElement('div');
    bodyDiv.classList.add('card-body');

    // Membuat elemen p untuk teks pertanyaan
    var questionP = document.createElement('p');
    questionP.innerHTML = soal.pertanyaan;

    // Menambahkan teks pertanyaan ke dalam bodyDiv
    bodyDiv.appendChild(questionP);

    // Membuat elemen div dengan id "jawaban"
    var jawabanDiv = document.createElement('div');
    jawabanDiv.id = 'jawaban';
    jawabanDiv.classList.add('row', 'mx-2');

    // Membuat radio button dan label beserta teksnya
    var options = soal.pilihan;
    options.forEach(function (option) {
        var optionDiv = document.createElement('div');
        optionDiv.classList.add('col-md-12', 'form-check');

        var radioInput = document.createElement('input');
        radioInput.classList.add('form-check-input');
        radioInput.type = 'radio';
        radioInput.name = data.id;
        radioInput.id = option.id + "_" + data.id; // Anda perlu memberikan id yang berbeda untuk setiap radio input
        if (option.benar) {
            radioInput.checked = true;
        }
        radioInput.disabled = true
        var label = document.createElement('label');
        label.classList.add('form-check-label');
        label.htmlFor = 'flexRadioDefault1'; // Sesuaikan dengan id radio input yang sesuai
        label.innerHTML = option.text;

        optionDiv.appendChild(radioInput);
        optionDiv.appendChild(label);

        jawabanDiv.appendChild(optionDiv);
    });

    // Menambahkan jawabanDiv ke dalam bodyDiv
    bodyDiv.appendChild(jawabanDiv);

    // Menambahkan bodyDiv ke dalam cardDiv
    cardDiv.appendChild(bodyDiv);

    // Menambahkan cardDiv ke dalam DOM di dalam elemen dengan id "cardContainer"
    return cardDiv;
}

function deleteSoal(id) {
    axios.delete(dsa + `/soal/delete/${id}`)
        .then(function (response) {
            if (response.status == 200) {
                Toastify({
                    text: "Berhasil Menghapus!",
                    duration: 3000
                }).showToast();
                var card = document.getElementById(`cardSoal_${id}`);
                card.remove();

            }
        })
        .catch(function (error) {
            console.log(error``)
            Toastify({
                text: `<strong>${error.status}</strong> ${error.message}`,
                duration: 1000,
                style: {
                    background: "linear-gradient(to right, #e74c3c, #c0392b)",
                },
            }).showToast();
        })
}