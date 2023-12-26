@extends('template.dashboard.dasboard-template')

@section('title', 'Hasil')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endsection

@section('page-heading', 'Hasil Kuis')

@php

    // dd($hasil,$soal);
    $inputMilidetik = $hasil->waktu_mengerjakan; // Contoh input dalam milidetik (620000 milidetik = 10 menit 20 detik)

    // Menghitung menit dan detik
    $menit = floor($inputMilidetik / 60000); // 1 menit = 60000 milidetik
    $sisaMilidetik = $inputMilidetik % 60000;
    $detik = $sisaMilidetik / 1000; // 1 detik = 1000 milidetik

    // Format hasil
    $waktuFormat = sprintf('%d menit %d detik', $menit, $detik);

    // dd($parseKonfigurasi);

    // Menampilkan waktu

    // dd($soal, $kuis);

@endphp
@include('pages.dashboard.hasil.blade_helper.model_soal')
@section('main')

    <div class="row">
        <div class="col-md-8">
            <h3>Jawaban Peserta</h3>
            @php $no = 0 @endphp
            @foreach ($soal as $soal)

                @foreach ($hasil->jawaban_user as $jawaban)
                    @if ($soal->id == $jawaban->id)
                        @switch($soal->jenis_soal)
                            @case('pilihanGanda')
                                @php echo pilihanGanda($no+=1, $soal, $jawaban) @endphp
                            @break
                            @case('isianSingkat')
                                @php echo isianSingkat($no+=1, $soal, $jawaban) @endphp
                            @break

                            @default
                        @endswitch

                    @endif
            @endforeach
        @endforeach

        {{-- <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="">
                            <h5 class="align-self-center">Soal 1</h5>
                        </div>
                        <div class="">
                            <span class="badge rounded-pill text-bg-danger">Salah</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="mb-4">
                        hal apa yang menjadi hal yang paling dibenci
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class=" rounded-3 p-2 border border-danger d-flex justify-content-start">
                                <button class="btn btn-danger">A</button> <div class="ms-3">Hell</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class=" rounded-3 p-2 border border-secondary d-flex justify-content-start">
                                <button class="btn btn-secondary">B</button> <div class="ms-3">Hell</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" rounded-3 p-2 border border-secondary d-flex justify-content-start">
                                <button class="btn btn-secondary">C</button> <div class="ms-3">Hell</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" rounded-3 p-2 border border-success d-flex justify-content-start">
                                <button class="btn btn-success">D</button> <div class="ms-3">Hell</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="">
                            <h5 class="align-self-center">Soal 2</h5>
                        </div>
                        <div class="">
                            <span class="badge rounded-pill text-bg-danger">Benar</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="mb-4">
                        hal apa yang menjadi hal yang paling dibenci
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="rounded-3 p-2 border border-danger">
                                <span class="badge rounded-pill text-bg-danger mb-2">Jawaban Peserta</span>
                                <input type="text" name="" class="form-control" disabled value="kebenaran" id="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="rounded-3 p-2 border border-success">
                                <span class="badge rounded-pill text-bg-success mb-2">Jawaban Benar</span>
                                <input type="text" name="" class="form-control" disabled value="kebenaran" id="">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
    </div>
    <div class="col-md-4 order-md-last">
        <div class="card">
            <div class="card-header">
                <h4>Data peserta</h4>
            </div>
            <div class="card-body">
                <h3>{{ $peserta_kuis->peserta->nama }}</h3>
                <h5>{{ $peserta_kuis->peserta->nis . ' | ' . $peserta_kuis->peserta->email }}</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Hasil</h4>
            </div>
            <div class="card-body">
                <h1 class="text-center mt-3" style="font-size: 100px">{{ $hasil->nilai }} </h1>
                <table class="table">
                    <tr>
                        <td scope="row">Jumlah Poin</td>
                        <td>{{ $hasil->poin . ' / ' . $hasil->jumlahPoin }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Jawaban Benar</td>
                        <td>{{ $hasil->jumlahBenar }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Jawaban Salah</td>
                        <td>{{ count($hasil->jawaban_user) - $hasil->jumlahBenar }}/90</td>
                    </tr>
                    <tr>
                        <td scope="row">Waktu Mengerjakan</td>
                        <td>{{ $waktuFormat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script></script>
@endsection
78
