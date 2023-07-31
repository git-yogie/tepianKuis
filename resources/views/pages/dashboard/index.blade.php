@extends('template.dashboard.dasboard-template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

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
                                    <h6 class="font-extrabold mb-0">112.000</h6>
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
                                    <h6 class="font-extrabold mb-0">183.000</h6>
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
                                    <h6 class="text-muted font-semibold">Api Request Today</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
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
                </div>
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
                    <button class="btn btn-primary mt-3 btn-block"> <i class="bi bi-person-lines-fill mr-2"></i>
                        Profile</button>
                </div>
            </div>
            <div class="card ">
                <div class="card-content p-4">
                    <div class="mx-2">
                        <B>Api Key</B>
                        <p class="border p-1 rounded-2"><i class="bi bi-clipboard"></i> {{ Auth::user()->api_key }}</p>
                    </div>
                    <div class="mx-2" style="height: 40px!">
                        <B>End Point</B>
                        <p class="border p-1 rounded-2 ">http://127.0.0.1:8000/api/{{ Auth::user()->api_key }}/kuis_id</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-bell-fill text-primary"></i> Notifikasi</h4>
                </div>
                <div class="card-body">
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">System</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                           Anda harus bayar!
                        </div>
                    </div>
                    <div class="toast bg-danger show mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">System</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-white">
                            Penggunaan API Anda mencapai 5000 request
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/dashboard.js"></script>
@endsection
