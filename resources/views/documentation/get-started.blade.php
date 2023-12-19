@extends('template.dashboard.dasboard-template')

@section('title', 'Dokumentasi API')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/dracula.min.css">
@endsection

@section('page-heading', 'Dokumentasi API')

@section('main')
    <div class="container">
        <div class="card ">
            <div class="card-body">
                <h3>Pengenalan API</h3>
                <p>Selamat datang di API Manajemen Tepian Kuis, Api ini dirancang untuk memungkinkan anda secara fleksible
                    mengelola dan mengatur kuis serta peserta kuis dalam aplikasi anda, API ini memberikan berbagai fitur
                    yang memungkinkan anda untuk :</p>
                <ol>
                    <div class="row">
                        <div class="col-md-6">
                            <li>Mengakses Data Kuis</li>
                            <li>Mendapatkan Hasil kuis</li>
                            <li>Mendapatkan data peserta kuis</li>
                            <li>Mendaftarkan pengguna aplikasi anda ke tepian kuis</li>
                        </div>
                        <div class="col-md-6">
                            <li>Mendapatkan Soal Kuis</li>
                            <li>Menambahkan peserta ke kuis tertentu</li>
                        </div>
                    </div>
                </ol>
                <h5>Mengakses API</h5>
                <p>API dilindungi menggunakan X-API-KEY, sehingga untuk mengakses API setiap permintaan (request) perlu
                    menyertakan X-API-KEY pada header, API KEY bisa anda temukan pada Dashboard.</p>
                <div class="alert alert-secondary text-white" role="alert">
                    <code>Setiap endpoint diakses melalui BASE URL :
                        <b>{{ url('/') . '/api/tepian_quiz/{endpoint}' }}</b></code>
                </div>

                <br>
                <code>Berikut adalah contoh kode untuk mengakses API Tepian Kuis pada JavaScript dan PHP</code>
                <div class="container">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-js"
                                type="button" role="tab" aria-controls="nav-js" aria-selected="true">Vanila JS</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-axios"
                                type="button" role="tab" aria-controls="nav-axios" aria-selected="false">Axios</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-jquery"
                                type="button" role="tab" aria-controls="nav-jquery"
                                aria-selected="false">JQuery</button>
                            <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-php"
                                type="button" role="tab" aria-controls="nav-php" aria-selected="false">PHP
                                CURL</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-js" role="tabpanel" aria-labelledby="nav-home-tab"
                            tabindex="0">
                            <div class="card border border-primary rounded-0">
                                <div class="card-body p-0">
                                    <code class="language-javascript code" style="white-space: pre;">
                                        // endpoint di isi sesuai dengan endpoint yang tersedia
                                        const apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta' }}';
                                        // Api token didapat pada dashboard tepian kuis;
                                        const apiToken = '{{ Auth::user()->api_key }}';

                                        const xhr = new XMLHttpRequest();
                                        xhr.open('GET', apiUrl, true);
                                        xhr.setRequestHeader('X-Api-Key', apiToken);
                                        xhr.onload = function () {
                                        if (xhr.status === 200) {
                                        const data = JSON.parse(xhr.responseText);
                                        console.log(data);
                                        } else {
                                        console.error('Gagal mengambil data:', xhr.status);
                                        }
                                        };

                                        xhr.send();
                                    </code>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-axios" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <div class="card border border-primary rounded-0">
                                <div class="card-body p-0">
                                    <code class="language-html code" style="white-space: pre;">&lt;script
                                        src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"&gt;&lt;/script&gt;
                                        &lt;script&gt;
                                        const apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta' }}';
                                        const apiToken = '{{ Auth::user()->api_key }}';
                                        axios({
                                        method: 'get',
                                        url: apiUrl,
                                        headers: {
                                        'X-Api-Key': apiToken
                                        }
                                        })
                                        .then(response => {
                                        console.log(response.data);
                                        })
                                        .catch(error => {
                                        console.error(error);
                                        });
                                        &lt;/script&gt;
                                    </code>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-jquery" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <div class="card border border-primary rounded-0">
                                <div class="card-body p-0">
                                    <code class="language-html code" style="white-space: pre;">&lt;script
                                        src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;
                                        &lt;script&gt;
                                        const apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta' }}';
                                        const apiToken = '{{ Auth::user()->api_key }}';

                                        $.ajax({
                                        url: apiUrl,
                                        type: 'GET',
                                        headers: {
                                        'X-Api-Key': apiToken
                                        },
                                        success: function (data) {
                                        console.log(data);
                                        },
                                        error: function (error) {
                                        console.error(error);
                                        }
                                        });
                                        &lt;/script&gt;
                                    </code>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-php" role="tabpanel" aria-labelledby="nav-disabled-tab"
                            tabindex="0">
                            <code class="code" style="white-space: pre;">
                                &lt;?php
                                $apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta' }}';
                                $apiToken = '{{ Auth::user()->api_key }}';

                                $ch = curl_init($apiUrl);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'X-Api-Key: ' . $apiToken
                                ]);

                                $response = curl_exec($ch);
                                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                                if ($httpCode === 200) {
                                $data = json_decode($response, true);
                                print_r($data);
                                } else {
                                echo 'Gagal mengambil data: ' . $httpCode;
                                }

                                curl_close($ch);
                                ?&gt;
                            </code>
                        </div>

                    </div>
                </div>
                <h3>Autentikasi dan Keamanan</h3>
                <p>API ini memerlukan penyertaan API-Key di setiap Permintaan ( Request ) sebagai saran untuk
                    mengautentikasi apakah anda adalah pengguna dari API ini, untuk keamanan lebih baik, perbarui API key
                    secara berkala!</p>


            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <h3>API Endpoint Peserta</h3>
                <p>Pada endpoint ini anda bisa melakukan pengelolaan terhadap data peserta yang terdaftar pada aplikasi anda
                    dan API ini, sehingga pengguna aplikasi anda bisa mengakses Kuis dan menyimpan hasil kuis mereka!</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nama EndPoint</th>
                                <th scope="col">Method</th>
                                <th scope="col">Parameter</th>
                                <th scope="col">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td>Mengambil data Peserta</td> --}}
                                <td>
                                    <code id="codeToCopy">
                                        /get/peserta
                                    </code>
                                </td>
                                <td><span class="badge text-bg-primary">GET</span></td>
                                <td>Tidak ada</td>
                                <td>Mengambil seluruh data Peserta</td>
                            </tr>
                            <tr>
                                <td>
                                    <code id="codeToCopy">
                                        /api/tepian_quiz/add/peserta
                                    </code>
                                </td>
                                <td><span class="badge text-bg-warning">POST</span></td>
                                <td>Tidak ada</td>
                                <td>Menambahkan data peserta</td>
                            </tr>
                            <tr>
                                <td>
                                    <code id="codeToCopy">
                                        /api/tepian_quiz/show/peserta/{id}
                                    </code>
                                </td>
                                <td><span class="badge text-bg-primary">GET</span></td>
                                <td>id <code>(integer)</code></td>
                                <td>Mengambil detail data peserta berdasarkan ID</td>
                            </tr>
                            <tr>
                                <td>
                                    <code id="codeToCopy">
                                        /api/tepian_quiz/edit/peserta/{id}
                                    </code>
                                </td>
                                <td><span class="badge text-bg-warning">POST</span></td>
                                <td>id <code>(integer)</code></td>
                                <td>Edit data peserta</td>
                            </tr>
                            <tr>
                                <td>
                                    <code id="codeToCopy" class="language-html">
                                        /api/tepian_quiz/delete/peserta/{id}
                                    </code>
                                </td>
                                <td><span class="badge text-bg-danger">DELETE</span></td>
                                <td>id <code>(integer)</code></td>
                                <td>Edit data peserta</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container">


                    <h5>1. Endpoint <code>/get/peserta</code></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border border-secondary table-responsive p01">
                                <table class="table">
                                    <tr>
                                        <td><b>Endpoint</b></td>
                                        <td> <code id="codeToCopy" class="language-html">
                                                /api/tepian_quiz/get/peserta/
                                            </code></td>
                                    </tr>
                                    <tr>
                                        <td><b>Method</b></td>
                                        <td> <span class="badge text-bg-primary">GET</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Parameter</b></td>
                                        <td> Tidak ada</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contoh request</b></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><b>Form Data</b></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><b>Response</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">

                                                <code class="language-javascript code" style="white-space: pre;">
[
    {
        "id": 1,
        "nama": "tepian",
        "nis": "1111",
        "email": "tepian@gmail.com",
        "kelas": "XI B",
        "created_at": "2023-09-02T21:28:24.000000Z",
        "updated_at": "2023-10-08T01:35:04.000000Z"
    },
]
</code>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 border border-secodary p-2 border">
                            <h6>Get Peserta</h6>
                            <code class="language-javascript code" style="white-space: pre;">
const apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta' }}';
const apiToken = '{{ Auth::user()->api_key }}';

const xhr = new XMLHttpRequest();
xhr.open('GET', apiUrl, true);
xhr.setRequestHeader('X-Api-Key', apiToken);
xhr.onload = function () {
    if (xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        console.log(data);
    } else {
        console.error('Gagal mengambil data:', xhr.status);
    }
};
xhr.send();
                            </code>

                        </div>
                    </div>
                    <h5>2. Endpoint <code>/add/peserta</code></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border border-secondary table-responsive p01">
                                <table class="table">
                                    <tr>
                                        <td><b>Endpoint</b></td>
                                        <td> <code id="codeToCopy" class="language-html">
                                                /api/tepian_quiz/get/peserta/
                                            </code></td>
                                    </tr>
                                    <tr>
                                        <td><b>Method</b></td>
                                        <td> <span class="badge text-bg-warning text-light">POST</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Parameter</b></td>
                                        <td> Tidak ada</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contoh request</b></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><b>Form Data : key</b></td>
                                        <td>nama {<code>String</code>}, nis{<code>String</code>}, <br>
                                            email{<code>String</code>}, kelas{<code>String</code>}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><b>Response</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">

                                                <code class="language-javascript code" style="white-space: pre;">
[
    {
        "id": 1,
        "nama": "tepian",
        "nis": "1111",
        "email": "tepian@gmail.com",
        "kelas": "XI B",
        "created_at": "2023-09-02T21:28:24.000000Z",
        "updated_at": "2023-10-08T01:35:04.000000Z"
    },
]
</code>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 border border-secodary p-2 border">
                            <h6>Add Peserta</h6>
                            <code class="language-javascript code" style="white-space: pre;">
const apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta' }}';
const apiToken = '{{ Auth::user()->api_key }}';

var headers = {
    'Content-Type': 'application/json',
    'X-Api-Key': apiToken
};

var data = {
    nama: 'value1',
    nis: 'value2',
    email: 'value3',
    kelas: 'value4'
};

var xhr = new XMLHttpRequest();
xhr.open('POST', apiUrl, true);

// Mengatur header
for (var header in headers) {
    xhr.setRequestHeader(header, headers[header]);
}

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        console.log(response);
    }
};

var jsonData = JSON.stringify(data);

xhr.send(jsonData);
                            </code>

                        </div>
                    </div>


                    <h5>3. Endpoint <code>/get/peserta/{id}</code></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border border-secondary table-responsive p01">
                                <table class="table">
                                    <tr>
                                        <td><b>Endpoint</b></td>
                                        <td> <code id="codeToCopy" class="language-html">
                                                /api/tepian_quiz/get/peserta/{id}
                                            </code></td>
                                    </tr>
                                    <tr>
                                        <td><b>Method</b></td>
                                        <td> <span class="badge text-bg-primary">GET</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Parameter</b></td>
                                        <td> id {<code>integer</code>}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contoh request</b></td>
                                        <td> /api/tepian_quiz/get/peserta/1</td>
                                    </tr>
                                    <tr>
                                        <td><b>Form Data : key</b></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><b>Response</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">

                                                <code class="language-javascript code" style="white-space: pre;">
{
    "id": 1,
    "nama": "tepian",
    "nis": "1111",
    "email": "tepian@gmail.com",
    "kelas": "XI B",
    "created_at": "2023-09-02T21:28:24.000000Z",
    "updated_at": "2023-10-08T01:35:04.000000Z"
},
        </code>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 border border-secodary p-2 border">
                            <h6>Get Peserta berdasarkan Id</h6>
                            <code class="language-javascript code" style="white-space: pre;">
var idPeserta = 1
const apiUrl = '{{ url('/') . '/api/tepian_quiz/get/peserta/' }}'+ idPeserta;
const apiToken = '{{ Auth::user()->api_key }}';


var xhr = new XMLHttpRequest();
xhr.open('POST', apiUrl, true);
xhr.setRequestHeader('X-Api-Key', apiToken);

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        console.log(response);
    }
};

xhr.send(jsonData);
                            </code>
                        </div>
                    </div>
                </div>


            </div>
            <h5>4. Endpoint <code>/peserta/edit/{id}</code></h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-secondary table-responsive p01">
                        <table class="table">
                            <tr>
                                <td><b>Endpoint</b></td>
                                <td> <code id="codeToCopy" class="language-html">
                                        /api/tepian_quiz/peserta/edit/{id}
                                    </code></td>
                            </tr>
                            <tr>
                                <td><b>Method</b></td>
                                <td> <span class="badge text-bg-warning text-light">POST</span></td>
                            </tr>
                            <tr>
                                <td><b>Parameter</b></td>
                                <td> id {<code>{integer}</code>}</td>
                            </tr>
                            <tr>
                                <td><b>Contoh request</b></td>
                                <td> /api/tepian_quiz/peserta/edit/1</td>
                            </tr>
                            <tr>
                                <td><b>Form Data : key</b></td>
                                <td>nama {<code>String</code>}, nis{<code>String</code>}, <br>
                                    email{<code>String</code>}, kelas{<code>String</code>}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center"><b>Response</b></td>
                            </tr>
                            <tr>
                                <td colspan="2">

                                        <code class="language-javascript code" style="white-space: pre;">
{
     "message": "Berhasil mengupdate"
}
</code>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 border border-secodary p-2 border">
                    <h6>Edit Peserta</h6>
                    <code class="language-javascript code" style="white-space: pre;">

var idPeserta = 1
const apiUrl = '{{ url('/') . '/api/tepian_quiz/peserta/edit/' }}'+idPeserta;
const apiToken = '{{ Auth::user()->api_key }}';

var headers = {
'Content-Type': 'application/json',
'X-Api-Key': apiToken
};

var data = {
nama: 'value1',
nis: 'value2',
email: 'value3',
kelas: 'value4'
};

var xhr = new XMLHttpRequest();
xhr.open('POST', apiUrl, true);

// Mengatur header
for (var header in headers) {
xhr.setRequestHeader(header, headers[header]);
}

xhr.onreadystatechange = function () {
if (xhr.readyState === 4 && xhr.status === 200) {
var response = JSON.parse(xhr.responseText);
console.log(response);
}
};

var jsonData = JSON.stringify(data);

xhr.send(jsonData);
                    </code>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('mazer/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/go.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>

    <script>
        document.querySelectorAll('.code').forEach((block) => {
            console.log(block)
            hljs.highlightBlock(block);
        });
    </script>
@endsection
