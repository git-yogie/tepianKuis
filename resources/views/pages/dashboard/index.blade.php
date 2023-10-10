@extends('template.dashboard.dasboard-template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('mazer/extensions/sweetalert2/sweetalert2.min.css') }}">
@endsection

@php
    
    // data hari pertama
    $day1 = $data['jumlah_request_per_hari'][0][0];
    $day1_count = $data['jumlah_request_per_hari'][0][1];
    
    // data hari kedua
    $day2 = $data['jumlah_request_per_hari'][1][0];
    $day2_count = $data['jumlah_request_per_hari'][1][1];
    
    // data hari ke tiga
    $day3 = $data['jumlah_request_per_hari'][2][0];
    $day3_count = $data['jumlah_request_per_hari'][2][1];
    
@endphp

@section('page-heading', 'Dashboard User')

@section('main')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Kuis</h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['jumlahKuis'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Peserta</h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['jumlahPeserta'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fa-solid fa-server"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Request Api Hari Ini </h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['jumlahRequestToday'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Kuis</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table-kuis">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kuis</th>
                                        <th>Respon</th>
                                        <th>Peserta</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Perangkat Lunak</td>
                                        <td>20</td>
                                        <td>30</td>
                                        <td><span class="badge text-bg-success">Aktif</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Penggunaan API Harian</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-permintaan-api"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('mazer') }}/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->nama }}</h5>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3 btn-block" data-bs-toggle="modal" data-bs-target="#modal-profile">
                        <i class="bi bi-person-lines-fill mr-2"></i>
                        Profile</button>
                    <a href="{{ route('dashboard.logout') }}" class="btn btn-danger mt-1 btn-block"> <i
                            class="fa-solid fa-right-from-bracket"></i>
                        Logout</a>
                </div>
            </div>
            <div class="card ">
                <div class="card-content p-4">
                    <div class="mx-2 mb-2">
                        <B>Api Key <i class="bi bi-clipboard"></i> </B>
                        <p class="border p-1 rounded-2" id="api_key">{{ Auth::user()->api_key }}</p>
                        <button type="button" class="btn btn-primary" id="api_key_button"><i
                                class="fa-solid fa-rotate"></i> Perbarui</button>
                    </div>
                    <div class="mx-2" style="height: 40px!">
                        <B>End Point</B>
                        <p class="border p-1 rounded-2 " id="end_point">
                            {{ url('/') }}/api/</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profil Anda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_profile" method="post">
                        <input type="hidden" id="id_user" value="{{ Auth::user()->id }}">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->nama }}" name="nama"
                                id="nama" required aria-describedby="nama">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email"
                                required id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <input type="text" class="form-control" id="password_baru" name="password_baru"
                                aria-describedby="nama">
                            <div id="emailHelp" class="form-text">Isi password Baru jika ingin mengubah password</div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/dashboard.js"></script>
    <script src="{{ asset('mazer/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var dataTgl = {!! '["' . $day1 . '","' . $day2 . '","' . $day3 . '"]' !!}
        var datacount = {!! '["' . $day1_count . '","' . $day2_count . '","' . $day3_count . '"]' !!}

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
            plotOptions: {},
            series: [{
                name: 'Permintaan',
                data: datacount
            }],
            colors: '#435ebe',
            xaxis: {
                categories: dataTgl,
            },
        }


        // insilasisasi chart
        var ChartpermintaanAPI = new ApexCharts(document.querySelector("#chart-permintaan-api"), permintaanAPI);
        ChartpermintaanAPI.render();
    </script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

@endsection
