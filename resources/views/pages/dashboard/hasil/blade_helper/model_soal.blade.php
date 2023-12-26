@php

    function pilihanGanda($no, $soal, $jawabanData)
    {
        // dd($soal, $jawabanData);
        $soal_all = json_decode($soal->soal_data);
        // $jawaban = json_decode($jawabanData->data->soal_data);

        // dd($soal,$soal_all,$jawabanData,$jawaban);
        $benar = $jawabanData->hasil ? ['success', 'benar'] : ['danger', 'salah'];
        $pilihanHTML = ''; // Ganti nama variabel agar tidak konflik dengan variabel iterasi dalam loop foreach
        $pilihanAbjad = ['A', 'B', 'C', 'D', 'E'];
        $index = 0;
        foreach ($soal_all->pilihan as $pilihanItem) {
            $jawaban_benar = $pilihanItem->benar ? 'success' : 'danger';
            $jawaban_user = $pilihanItem->id == $jawabanData->jawaban ? 'success' : 'danger';

            // Ubah konstruksi string ini agar sesuai dengan pengecekan kondisi di luar string

            if ($pilihanItem->benar) {
                $pilihanHTML .=
                    ' <div class="col-md-6 mb-2">
            <div class="rounded-3 p-2 border border-' .
                    ($jawaban_benar == $jawaban_user ? 'success' : 'primary') .
                    ' d-flex justify-content-start">
                <button class="btn btn-' .
                    ($jawaban_user == $jawaban_benar ? 'success' : 'primary') .
                    '">' .
                    $pilihanAbjad[$index] .
                    '</button>
                <div class="ms-3">' .
                    $pilihanItem->text .
                    '</div>
            </div>
        </div>
    ';
            } else {
                $pilihanHTML .=
                    ' <div class="col-md-6 mb-2">
            <div class="rounded-3 p-2 border border-' .
                    ($jawaban_benar == $jawaban_user ? 'secondary' : 'danger') .
                    ' d-flex justify-content-start">
                <button class="btn btn-' .
                    ($jawaban_user == $jawaban_benar ? 'secondary' : 'danger') .
                    '">' .
                    $pilihanAbjad[$index] .
                    '</button>
                <div class="ms-3">' .
                    $pilihanItem->text .
                    '</div>
            </div>
        </div>
    ';
            }
            $index += 1;
        }

        // Perbaiki pemanggilan `$soal_all`
        return '
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-start justify-content-between">
                <div class="">
                    <h5 class="align-self-center">Soal ' .
            $no .
            '</h5>
                </div>
                <div class="">
                    <span class="badge rounded-pill text-bg-' .
            $benar[0] .
            '">' .
            $benar[1] .
            '</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                ' .
            $soal_all->pertanyaan .
            '
            </div>
            <div class="row">
                ' .
            $pilihanHTML .
            '
            </div>
        </div>
    </div>';
    }

    function isianSingkat($no, $soal, $jawaban)
    {
        return `  <div class="card">
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
                </div>`;
    }
@endphp
