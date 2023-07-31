@extends('template.dashboard.dasboard-template')

@section('title', 'Peserta')

@section('css')
    <style>
        .table-card {
            height: 50vh;
        }
    </style>
@endsection

@section('page-heading', 'Peserta Kuis')

@section('main')
    <div class="card table-card border">
        <div class="card-header d-flex justify-content-between">
            <h4>Data Peserta </h4>
            <button class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</button>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table-data-peserta">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="myCheckbox" name="myCheckbox"></th>
                        <th>Nama</th>
                        <th>Nisn</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" id="myCheckbox" name="myCheckbox"></td>
                        <td>Yogie Prayoga</td>
                        <td>201098</td>
                        <td>XI A</td>
                        <td>yogie.prayoga35@gmail.com</td>
                        <td>
                            <button class="btn btn-success"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('assets/js/dashboard/peserta.js') }}"></script>
@endsection
