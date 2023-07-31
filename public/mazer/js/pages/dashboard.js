
let table = new simpleDatatables.DataTable(document.getElementById("table-kuis"))
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


// add bs5 item on data table

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



// data untuk chart permintaan api
var permintaanAPI = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled: true
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity: 1
	},
	plotOptions: {
	},
	series: [{
		name: 'Permintaan',
		data: [85, 100, 90, 200]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["Jul 15", "jul 16", "Jul 17", "Jul 18"],
	},
}


// insilasisasi chart
var ChartpermintaanAPI = new ApexCharts(document.querySelector("#chart-permintaan-api"), permintaanAPI);
ChartpermintaanAPI.render();