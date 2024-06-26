@extends('template.dashboard.dasboard-template')

@section('title', 'Peserta')

@section('css')
    <style>
        .table-card {
           
        }
    </style>
       <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
       <link rel="stylesheet" href="{{ asset("mazer/extensions/sweetalert2/sweetalert2.min.css") }}">
    
@endsection

@section('page-heading', 'Peserta Kuis')

@section('main')
@include("pages.dashboard.components.modal_addPeserta")
    <div class="card table-card border">
        <div class="card-header d-flex justify-content-between">
            <h4>Data Peserta </h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-peserta" ><i class="bi bi-plus-lg"></i> Tambah</button>
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
                    <tbody>
                    </thead>
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
    {{-- <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script> --}}

    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="{{ asset("mazer/extensions/sweetalert2/sweetalert2.min.js") }}"></script>
    

    <script src="{{ asset('assets/js/dashboard/peserta.js') }}"></script>
@endsection
