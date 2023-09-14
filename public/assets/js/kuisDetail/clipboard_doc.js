const clipboard = new ClipboardJS('.copy-button-html', {
    target: function (trigger) {
        return trigger.closest(".card").querySelector(".language-html");

    }
});

clipboard.on('success', function (e) {
    e.clearSelection();
    Toastify({
        text: "Berhasil Menyalin! HTML",
        duration: 3000
    }).showToast();

});

clipboard.on('error', function (e) {
    console.error('Salin ke clipboard gagal:', e.action);
});

const clipboard1 = new ClipboardJS('.copy-button-javascript', {

    target: function (trigger) {
        return trigger.closest(".card").querySelector(".language-javascript");
    }
});

clipboard1.on('success', function (e) {
    e.clearSelection();
    Toastify({
        text: "Berhasil Menyalin! Javascript",
        duration: 3000
    }).showToast();
});


clipboard1.on('error', function (e) {
    console.error('Salin ke clipboard gagal:', e.action);
});
