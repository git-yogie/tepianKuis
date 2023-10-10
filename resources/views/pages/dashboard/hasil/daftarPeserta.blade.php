@extends('template.dashboard.dasboard-template')

@section('title', 'Hasil')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endsection

@section('page-heading', 'Hasil Kuis')

@section('main')
    <div class="card table-card border">
        <div class="card-header d-flex justify-content-between">
            <h4>Hasil Kuis</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table-data-hasil">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Identitas</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>Nilai CBT</th>
                        <th>Nilai Embed</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                        //    dd($peserta_kuis);
                    @endphp
                    @foreach ($peserta_kuis as $peserta)
                        <tr>
                            <td>{{ $no += 1 }}</td>
                            <td>{{ $peserta->peserta->nama }}</td>
                            <td>{{ $peserta->peserta->nis }}</td>
                            <td>{{ $peserta->peserta->kelas }}</td>
                            <td>{{ $peserta->peserta->email }}</td>
                            <td>{{ $peserta->jawaban_kuis_cbt != '{}' ? json_decode($peserta->jawaban_kuis_cbt)->nilai : 'Belum dikerjakan' }}
                            <td>{{ $peserta->jawaban_kuis_embed != '{}' ? json_decode($peserta->jawaban_kuis_embed)->nilai : 'Belum dikerjakan' }}
                            </td>
                            <td>
                                @if ($peserta->jawaban_kuis_cbt != '{}')
                                    <a class="btn btn-info mb-2"
                                        href="{{ route('hasil.daftar.peserta.hasil', ["cbt",$peserta->kuis_code, $peserta->id]) }}"><i
                                            class="bi bi-file-text"></i>Jawaban CBT</button>
                                @endif
                                @if ($peserta->jawaban_kuis_embed != '{}')
                                    <a class="btn btn-info"
                                        href="{{ route('hasil.daftar.peserta.hasil', ["embed",$peserta->kuis_code, $peserta->id]) }}"><i
                                            class="bi bi-file-text"></i>Jawaban Embed</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
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
78
