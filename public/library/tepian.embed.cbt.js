class EventEmitter {
    constructor() {
        this.events = {};
    }

    on(event, listener) {
        if (!this.events[event]) {
            this.events[event] = [];
        }
        this.events[event].push(listener);
    }

    emit(event, ...args) {
        if (this.events[event]) {
            this.events[event].forEach(listener => listener.apply(this, args));
        }
    }
}


class tepiancbt extends EventEmitter {
    saveAnsw = false;

    constructor(element, konfigurasi) {
        super();
        this.element = element;
        this.konfigurasi = konfigurasi;
        this.index_soal = 0;
        this.init();
        this.jawabanUser = [];
    }

    init() {
        this.axiosInit();
        this.emit("created");
        if (this.element instanceof HTMLElement) {

            this.element.appendChild(this.loadCSSBootstrap());
            this.element.appendChild(this.renderContainerWithNoSoal());
            this.element.appendChild(this.loadJsBootstrap());
            this.getData()

        } else {

        }
    }


    axiosInit() {
        this.apiClient = axios.create({
            baseURL: "http://127.0.0.1:8000/api/embed/quiz",
            timeout: 30000,
            headers: {
                'X-Api-Key': this.konfigurasi.Key,
            }
        })
    }

    peserta(data) {
        this.dataPeserta = data;
        return this
    }


    saveAnswer(save) {
        if (save && typeof this.dataPeserta != 'undefined') {
            this.saveAnsw = true;
            console.log(save)
        } else {
            this.saveAnsw = false;
            console.error("undefined User");
        }
    }

    sendUserAnswer(data) {
        var sendObj = {
            peserta: this.dataPeserta,
            jawaban: data
        }

        this.apiClient.post("/save/" + this.konfigurasi.quiz, sendObj)
            .then(Response => {
                console.log(Response);
            })
            .catch(error => {
                console.log(error)
            });
    }

    nextSoal() {

        if (this.index_soal <= this.soal_len) {
            this.index_soal += 1
            this.prev.disabled = false
            if (this.soal_len === this.index_soal) {
                this.finishQuiz()
            } else {
                this.soalText()
            }

        }

        if (this.soal_len - 1 === this.index_soal) {
            this.next.textContent = "Selesai"
        }

    }

    finishQuiz() {

        const currentDate = new Date();

        const day = currentDate.getDate().toString().padStart(2, '0');
        const month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Bulan dimulai dari 0, tambahkan 1
        const year = currentDate.getFullYear();
        const hours = currentDate.getHours().toString().padStart(2, '0');
        const minutes = currentDate.getMinutes().toString().padStart(2, '0');
        const seconds = currentDate.getSeconds().toString().padStart(2, '0');

        const formattedTime = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;

        this.soal.innerHTML = ""
        this.jawaban.innerHTML = "";
        this.next.classList.add("d-none")
        this.prev.classList.add("d-none")
        let containerWidth = this.soal.offsetWidth;

        let row = document.createElement("div");
        row.classList.add("row");

        let colLeft = document.createElement("div");
        colLeft.classList.add("col-6");

        let colRight = document.createElement("div");
        colRight.classList.add("col-6", "text-center");

        let image = document.createElement("img")
        image.src = "https://tepiankuis.softforge.my.id/library/asset/selesai.png";
        image.classList.add("img-fluid");

        let textPoin = document.createElement("h2")
        textPoin.innerHTML = "50";
        textPoin.classList.add("text-center")
        textPoin.style = "font-size : 100px;"

        let textBenar = document.createElement("p");

        textBenar.classList.add("text-center")

        let tombolUlang = document.createElement("button");
        tombolUlang.textContent = "Coba Lagi"
        tombolUlang.classList.add("btn", "btn-primary")
        tombolUlang.style = "margin: auto;"


        const poin = this.jawabanUser.reduce((totalPoin, element) => {
            if (element.hasil) {
                return totalPoin + parseInt(element.data.poin, 10);
            }
            return totalPoin;
        }, 0);

        const jumlahBenar = this.jawabanUser.filter(element => element.hasil).length;

        const jumlahPoin = this.soal_data.soal.reduce((totalPoin, element) => totalPoin + parseInt(element.poin, 10), 0);

        const nilai = ((jumlahBenar / this.soal_len) * 100).toFixed(1);
        const nilai_poin = ((poin / jumlahPoin) * 100).toFixed(1);

        const finishedQuiz = {
            jawaban: this.jawabanUser,
            poin: poin,
            benar: jumlahBenar,
            nilai: nilai
        };
        this.emit("selesai", { jawaban: this.jawabanUser, poin: poin, benar: jumlahBenar, nilai_poin: nilai_poin });

        if (this.saveAnsw) {
            this.sendUserAnswer({
                jawaban_user: this.jawabanUser,
                jumlahBenar: jumlahBenar,
                nilai: ((jumlahBenar / this.soal_len) * 100).toFixed(1),
                jumlahPoin: jumlahPoin,
                poin: poin,
                waktu_mengerjakan: 0,
                waktu_selesai: formattedTime
            });
        }

        textBenar.textContent = "Benar :" + jumlahBenar;
        textPoin.textContent = `${((jumlahBenar / this.soal_len) * 100).toFixed(1)}`

        if (containerWidth <= 480) {
            row.style = "margin : auto; width: 100%;"
            textPoin.style = "font-size : 60px;"
        } else if (containerWidth > 480 && containerWidth <= 768) {
            textPoin.style = "font-size : 60px;"
            row.style = "margin : auto; width: 100%;"
        } else {
            row.style = "margin : auto; width: 50%;"
        }

        colLeft.appendChild(image);
        colRight.appendChild(textPoin);
        colRight.appendChild(textBenar);
        colRight.appendChild(tombolUlang);

        this.emit('finish', this.finishedQuiz);
        // event listener untuk button ulang quiz
        tombolUlang.addEventListener("click", () => {

            this.next.classList.remove("d-none")
            this.next.textContent = "Selanjutnya"
            this.prev.classList.remove("d-none")
            this.index_soal = 0;
            this.jawabanUser = [];
            this.setSoal();
            this.soalText();

        });

        row.appendChild(colLeft);
        row.appendChild(colRight);

        this.soal.appendChild(row);
    }

    prevSoal() {
        if (0 !== this.index_soal) {
            this.index_soal -= 1;
            this.next.textContent = "Selanjutnya"
            this.soalText()
        }
        if (this.index_soal === 0) {
            this.prev.disabled = true
        }
    }

    getData() {
        this.apiClient.get("/get/" + this.konfigurasi.quiz)
            .then(Response => {
                const data = Response.data;
                this.soal_data = data;
                const soal = data.soal
                this.soal_len = soal.length;

                this.renderNoSoal();

                this.soalText();
                // this.setSoal(data)

                this.setNoSoalActive();


                this.prev.addEventListener("click", () => this.prevSoal());
                this.prev.disabled = true;
                this.next.addEventListener("click", () => this.nextSoal());

            })
            .catch(error => {
                console.error("error", error);
            })
    }

    soalText() {
        this.number.innerHTML = (this.index_soal + 1) + " / " + this.soal_len;
        this.setNoSoalActive()
        this.setSoal()
    }

    setSoal() {
        // console.log(this.soal_data);
        const soal_sekarang = this.soal_data.soal[this.index_soal]
        const soal = JSON.parse(soal_sekarang.soal_data)
        this.soal.innerHTML = soal.pertanyaan

        this.renderJawaban(soal_sekarang);
        console.log(this.soal_data.soal);
    }

    renderJawaban(data) {
        var soal = JSON.parse(data.soal_data)
        switch (data.jenis_soal) {
            case "pilihanGanda":
                this.renderPilihanGanda(data, soal.pilihan)
                break;
            case "isianSingkat":
                this.renderIsianSingkat(data);
                break;
            default:
                break;
        }
    }

    loadCSSBootstrap() {
        const linkElement = document.createElement("link");
        linkElement.setAttribute("rel", "stylesheet");
        linkElement.setAttribute("href", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css");
        linkElement.setAttribute("integrity", "sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9");
        linkElement.setAttribute("crossorigin", "anonymous");

        return linkElement;
    }

    loadJsBootstrap() {
        const scriptElement = document.createElement("script");
        scriptElement.setAttribute("src", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js");
        scriptElement.setAttribute("integrity", "sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm");
        scriptElement.setAttribute("crossorigin", "anonymous");

        return scriptElement;
    }

    loadAxios() {
        const scriptElement = document.createElement("script");
        scriptElement.setAttribute("src", "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js");

        document.head.appendChild(scriptElement);
        return scriptElement;
    }

    renderContainer() {

        var container = document.createElement("div");
        container.classList.add("card");

        const cardHeader = document.createElement("div");
        cardHeader.classList.add("card-header", "d-flex", "justify-content-between", "align-items-baseline");

        const heading = document.createElement("h5");
        heading.id = "nomerSoal";
        if ('title' in this.konfigurasi) {
            heading.textContent = this.konfigurasi.title;
        } else {
            heading.textContent = "Pertanyaan";
        }
        // append heading
        cardHeader.appendChild(heading);

        const nav = document.createElement("div");
        nav.classList.add("d-flex", "justify-content-between", "align-items-center");

        const buttonNext = document.createElement("button");
        buttonNext.classList.add("btn", "btn-sm", "btn-primary", "mx-2");
        buttonNext.id = "nextSoal";
        buttonNext.textContent = "selanjutnya"

        const buttonPrev = document.createElement("button");
        buttonPrev.classList.add("btn", "btn-sm", "btn-primary", "mx-2");
        buttonPrev.id = "prevSoal";
        buttonPrev.textContent = "sebelumnya";


        const textNomer = document.createElement("h4");
        textNomer.id = "nomerSoal";
        textNomer.textContent = "0/0";


        nav.appendChild(buttonPrev);
        nav.appendChild(textNomer);
        nav.appendChild(buttonNext);

        cardHeader.appendChild(nav);
        container.appendChild(cardHeader);


        const cardBodyDiv = document.createElement("div");
        cardBodyDiv.className = "card-body";

        const soalDiv = document.createElement("div");
        soalDiv.id = "soal-render";

        const jawabanDiv = document.createElement("div");
        jawabanDiv.id = "jawaban";
        jawabanDiv.className = "row mx-2";

        // set all to global
        this.prev = buttonPrev;
        this.next = buttonNext;
        this.number = textNomer;
        this.headingCard = heading;

        this.soal = soalDiv;
        this.jawaban = jawabanDiv;

        cardBodyDiv.appendChild(soalDiv);
        cardBodyDiv.appendChild(jawabanDiv);
        container.appendChild(cardBodyDiv);

        return container;
    }

    getUserAnswer() {
        const data = this.soal_data.soal[this.index_soal];
        // console.log(data)
        var soal = JSON.parse(data.soal_data);

        switch (data.jenis_soal) {
            case "pilihanGanda":
                const checkedRadioButton = [...document.querySelectorAll('input[name="' + data.id + '"]:checked')][0];
                if (checkedRadioButton) {
                    var hasil = soal.pilihan.find(item => item.id === checkedRadioButton.id).benar;
                    var indexOfJawaban = this.jawabanUser.findIndex(item => item.id === data.id);

                    if (indexOfJawaban != -1) {
                        this.jawabanUser[indexOfJawaban].jawaban = checkedRadioButton.id;
                        this.jawabanUser[indexOfJawaban].hasil = hasil;
                    } else {
                        this.jawabanUser.push({
                            id: data.id,
                            data: { id: data.id, poin: data.poin },
                            soal: soal,
                            jawaban: checkedRadioButton.id,
                            hasil: hasil
                        })
                    }
                    console.log(this.jawabanUser)
                }
                break;
            case "isianSingkat":
                var input = document.getElementById(data.id);
                var hasil = soal.jawaban == input.value ? true : false;

                if (input.value.length > 0) {
                    var indexOfJawaban = this.jawabanUser.findIndex(item => item.id === data.id);
                    if (indexOfJawaban === -1) {
                        this.jawabanUser.push({
                            id: data.id,
                            data: { id: data.id, poin: data.poin },
                            soal: soal,
                            jawaban: input.value,
                            hasil: hasil,
                        })
                    } else {
                        this.jawabanUser[indexOfJawaban].jawaban = input.value;
                    }
                }
                break;
            default:
                break;
        }
        // console.log(this.jawabanUser)
    }

    renderPilihanGanda(data, pilihan) {

        const self = this;
        const abj = ["A", "B", "C", "D", "E", "F"]
        this.jawaban.innerHTML = ''
        this.jawaban.classList.add("row")
        let saved = self.jawabanUser.find(item => item.id === data.id);
        var i = 0;
        pilihan.forEach(function(option) {
            var optionDiv = document.createElement('div');
            optionDiv.classList.add('form-check', 'd-flex', 'align-items-baseline', 'border', "p-3", "outer", "rounded-4", "m-1");
            let containerWidth = self.soal.offsetWidth;

            if (containerWidth <= 480) {
                optionDiv.classList.add("col-md-12")
            } else if (containerWidth > 480 && containerWidth <= 768) {
                optionDiv.classList.add("col-md-5")
            } else {

            }

            optionDiv.id = "outer_" + option.id;
            optionDiv.style = "cursor: pointer;"
            var radioInput = document.createElement('input');
            var divClear = document.createElement("div");
            var soal = document.createElement("p");

            soal.classList.add("mx-4", "text-center", "align-self-center");
            soal.style = "margin-top:auto";
            soal.innerHTML = option.text;


            divClear.appendChild(soal);

            radioInput.classList.add("jawaban-soal", "btn-check");
            radioInput.type = 'radio';
            radioInput.name = data.id;
            radioInput.id = option.id; // Anda perlu memberikan id yang berbeda untuk setiap radio input

            var label = document.createElement('label');
            label.classList.add('btn', 'btn-outline-primary', "pilihan");
            label.htmlFor = option.id; // Sesuaikan dengan id radio input yang sesuai
            label.innerHTML = abj[i];
            // label.innerHTML = option.text;


            optionDiv.addEventListener("click", () => {
                radioInput.checked = true;
                var elements = document.querySelectorAll(".outer");
                elements.forEach(function(element) {
                    element.classList.remove("border-primary");
                });
                radioInput.closest(".outer").classList.add("border-primary")
                self.getUserAnswer();
            })

            radioInput.addEventListener("change", (e) => {
                var elements = document.querySelectorAll(".outer");
                elements.forEach(function(element) {
                    element.classList.remove("border-primary");
                });
                radioInput.closest(".outer").classList.add("border-primary")
                self.getUserAnswer();
            })

            optionDiv.appendChild(radioInput);
            optionDiv.appendChild(label);
            optionDiv.appendChild(divClear);

            if (saved) {
                if (saved.jawaban == option.id) {
                    radioInput.checked = true;
                    radioInput.closest(".outer").classList.add("border-primary")
                }
            }

            self.jawaban.appendChild(optionDiv);
            i++;
        });

    }

    renderIsianSingkat(data) {
        this.jawaban.innerHTML = '';
        const self = this;
        let saved = this.jawabanUser.find(item => item.id === data.id);
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

        this.timeout = null;
        input.addEventListener('keyup', () => {
            clearTimeout(this.timeout);

            self.timeout = setTimeout(function() {
                self.getUserAnswer(data)
                    // console.log(self.jawabanUser);
            }, 1000)

        })

        label.setAttribute("for", data.id);
        label.textContent = "Jawaban";

        container.appendChild(label);
        container.appendChild(input);

        this.jawaban.appendChild(container);


    }

    renderContainerWithNoSoal() {
        var container = document.createElement("div");
        container.classList.add(["row"]);

        var col1 = document.createElement("div");
        col1.classList.add("col-md-8");

        col1.appendChild(this.renderContainer());

        var col2 = document.createElement("div");
        col2.classList.add("col-md-4");
        col2.appendChild(this.containerNoSoal());

        container.appendChild(col1);
        container.appendChild(col2);

        return container;
    }

    renderNoSoal() {
        this.containerNoSoal.innerHTML = "";
        const soal = this.soal_data.soal;
        const self = this;
        soal.forEach(function(element, index) {
            const numberBox = self.noSoalElement();
            numberBox.textContent = index + 1;
            numberBox.id = "no_" + element.id
            numberBox.addEventListener("click", () => {
                self.index_soal = index;
                self.soalText();
            })
            self.containerNoSoal.appendChild(numberBox);
        })
    }

    setNoSoalActive() {
        const nodes = this.containerNoSoal.childNodes;
        const curentSoal = this.soal_data.soal[this.index_soal]

        console.log(nodes);
        console.log(curentSoal.id);
        let elementNumber = -1;
        nodes.forEach(function(element, index) {
            let id = element.id.split("_")[1];
            if (curentSoal.id == id) {
                elementNumber = element
            }

            if (element.classList.contains("border")) {
                element.classList.remove("border", "border-primary")
            }

            if (!element.classList.contains("btn-outline-secondary")) {
                element.classList.add("btn-outline-secondary")
            }



            console.log(element.classList)

        });

        if (elementNumber != -1) {
            elementNumber.classList.remove("btn-outline-secondary");
            elementNumber.classList.add("border", "border-primary");
        }

    }




    noSoalElement() {
        const numberBox = document.createElement("button");
        numberBox.classList.add("btn", "btn-outlined-secondary", "col-auto", "m-1", "p-5", "");
        numberBox.textContent = "1";

        const span = document.createElement("span");
        span.classList.add("badge", "text-bg-primary")
        span.textContent = "sudah"

        numberBox.appendChild(span);
        return numberBox;
    }

    containerNoSoal() {
        const card = document.createElement("div");
        card.classList.add("card");

        const cardHeader = document.createElement("div");
        cardHeader.classList.add("card-header");
        cardHeader.textContent = "Nomer Soal";

        const cardBody = document.createElement("div");
        cardBody.classList.add("card-body", "row");

        // const numberBox = document.createElement("button");
        // numberBox.classList.add("btn", "btn-outline-secondary", "col-auto", "m-2", "p-4");
        // numberBox.textContent = "1";

        // cardBody.appendChild(numberBox);

        card.appendChild(cardHeader);
        card.appendChild(cardBody);


        this.containerNoSoal = cardBody;

        return card

    }




}
