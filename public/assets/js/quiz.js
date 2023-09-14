document.addEventListener("DOMContentLoaded", () => {
    const quiz_question_el = document.querySelector("#soal-render");
    let fontSize = 16;

    function setFontSize() {
        quiz_question_el.style.fontSize = `${fontSize}px`;
    }

    const zoom_in = document.getElementById("zoom-in");
    const zoom_out = document.getElementById("zoom-out");

    zoom_in.addEventListener("click", (e) => {
        console.log(e)
        if(fontSize < 40){
            fontSize += 5;
            setFontSize()
        }

    });

    zoom_out.addEventListener("click", () => {
        if(fontSize >= 16){
            fontSize -= 5;
            setFontSize()
        }
    });

    


});
