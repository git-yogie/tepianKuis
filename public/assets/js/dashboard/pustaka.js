document.addEventListener("DOMContentLoaded",function(){
    var modal = new bootstrap.Modal(this.getElementById("form_create_quiz"));
    var create_quiz_button  = this.getElementById("button_buat_kuis");

    create_quiz_button.addEventListener("click",function(){
        modal.show();
    })

    FilePond.create(document.querySelector(".image-preview-filepond"), {
        credits: null,
        allowImagePreview: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
        fileValidateTypeDetectType: (source, type) =>
          new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            resolve(type)
          }),
        storeAsFile: true,
      })
    





})