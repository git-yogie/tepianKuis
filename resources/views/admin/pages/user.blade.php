@extends('admin.template')


@section('title', 'user')



@section('css')
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
@endsection

@section('main-content')
    <div class="page-heading">
        <h3>Tepian Dashboard</h3>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Pengguna</h3>
                <button class="btn btn-sm btn-primary" onclick="tambah()"><i class="fa-solid fa-user-plus"></i> Tambah</button>
            </div>
            <div class="card-body">
                <div id="table" class="table-responsive"></div>
            </div>
        </div>
    </div>

    @include('admin.modal.user_modal')
@endsection

@section('js')
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script>
        let Grid = null
        // load first data
        axios.get("{{ route('admin.api.user') }}")
            .then((response) => {
                const data = response.data
                renderTable(data)
            })
            .catch((error) => {
                console.log(error)
            })

        renderTable = (data) => {
            Grid = new gridjs.Grid({
                columns: ["Id", "Nama", "Email", {
                    name: "aksi",
                    formatter: (_, row) => gridjs.html(
                        ` <button onclick = "edit(${row.cells[0].data})" class = "btn btn-sm btn-warning" > <i class = "fa-solid fa-user-edit" ></i> Edit</button >
                            <button onclick = "hapus(${row.cells[0].data})" class = "btn btn-sm btn-danger" > <i class = "fa-solid fa-user-slash" ></i> Hapus</button >
                                <button onclick = "login(${row.cells[0].data},'${row.cells[1].data}')" class = "btn btn-sm btn-primary" > <i class="fa-solid fa-right-to-bracket"></i> Masuk</button >
                            `
                    )
                }],
                data: data.map((item) => {
                    return [
                        item.id,
                        item.nama,
                        item.email,
                        null

                    ]
                }),
                search: true,
                sort: true,
                pagination: {
                    limit: 5,
                    summary: false
                },
                language: {
                    'search': {
                        'placeholder': '🔍 Cari pengguna...'
                    },
                    'pagination': {
                        'previous': 'Sebelumnya',
                        'next': 'Selanjutnya',
                        'showing': '😃 Displaying',
                        'results': () => 'Hasil'
                    }
                }
            }).render(document.getElementById("table"))
        }

        renewData = () => {
            axios.get("{{ route('admin.api.user') }}")
                .then((response) => {
                    const data = response.data
                    Grid.updateConfig({
                        data: data.map((item) => {
                            return [
                                item.id,
                                item.nama,
                                item.email,
                                null

                            ]
                        })
                    }).forceRender()
                })
                .catch((error) => {
                    console.log(error)
                })
        }
    </script>
    @include('admin\javascript\user_js')
@endsection
