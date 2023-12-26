@extends('template.dashboard.dasboard-template')

@section('title', 'Hasil')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endsection

@section('page-heading', 'Hasil Kuis')

@section('main')
    <div class="card table-card border">
        <div class="card-header d-flex justify-content-between">
            <h4>Daftar Kuis</h4>
            <div class="row" style="width:400px">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-data-hasil">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kuis</th>
                            <th>Tingkat</th>
                            <th>Mata Pelajaran</th>
                            <th>Jumlah Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php
                           $no = 0;
                       @endphp
                        @foreach ($quiz as $quizs)
                            <tr>
                                <td>{{ $no+=1 }}</td>
                                <td>{{ $quizs->nama }}</td>
                                <td>{{ $quizs->tingkatan }}</td>
                                <td>{{ $quizs->mata_pelajaran }}</td>
                                <td>{{ $quizs->peserta_count }}</td>
                                <td>
                                    <a class="btn btn-info" href=" {{ route("hasil.daftar.peserta",$quizs->kuis_code) }}"><i class="bi bi-file-text"></i> Lihat Hasil</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        const dataTable = $("#table-data-hasil").DataTable({

        });
    </script>
@endsection
