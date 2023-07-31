var tablePeserta = document.getElementById("table-data-peserta");
let table = new simpleDatatables.DataTable(tablePeserta);

table.on("datatable.init", function () {
    adaptPageDropdown();
    adaptPagination();

    // modifikasi top data table supaya display flex;
    var tableTop = document.querySelector(".dataTable-top");
    tableTop.classList.add("d-flex")
    tableTop.classList.add("justify-content-between")
});

table.on("datatable.init", function () {

});

function adaptPageDropdown() {
    const selector = table.wrapper.querySelector(".dataTable-selector");
    selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
    selector.classList.add("form-select");
}

function adaptPagination() {
    const paginations = table.wrapper.querySelectorAll(
        "ul.dataTable-pagination-list"
    );

    for (const pagination of paginations) {
        pagination.classList.add(...["pagination", "pagination-primary"]);
    }

    const paginationLis = table.wrapper.querySelectorAll(
        "ul.dataTable-pagination-list li"
    );

    for (const paginationLi of paginationLis) {
        paginationLi.classList.add("page-item");
    }

    const paginationLinks = table.wrapper.querySelectorAll(
        "ul.dataTable-pagination-list li a"
    );

    for (const paginationLink of paginationLinks) {
        paginationLink.classList.add("page-link");
    }
}
