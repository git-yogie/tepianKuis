@extends('template.dashboard.dasboard-template')

@section('title', 'Hasil')

@section('css')

@endsection

@section('page-heading', 'Hasil Kuis')

@section('main')
    <div class="card table-card border">
        <div class="card-header d-flex justify-content-between">
            <h4>Data Peserta </h4>
            <div class="row" style="width:400px">
                <div class="col-8">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Kuis</option>
                        <option value="1">Perangkat lunak</option>
                        <option value="2">perangkat keras</option>
                        <option value="3">Bangun Ruang</option>
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-info"><i class="bi bi-file-earmark-excel"></i> Export</button>
                </div>

            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table-data-hasil">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="myCheckbox" name="myCheckbox"></th>
                        <th>Nama</th>
                        <th>Nisn</th>
                        <th>Kelas</th>
                        <th>Kuis</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" id="myCheckbox" name="myCheckbox"></td>
                        <td>Yogie Prayoga</td>
                        <td>201098</td>
                        <td>XI A</td>
                        <td>Perangkat Lunak</td>
                        <td>80</td>
                        <td>
                            <button class="btn btn-info"><i class="bi bi-file-text"></i> Jawaban</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script>
@endsection
