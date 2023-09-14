<div class="modal fade" id="modal-pilih-soal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">
                    Buat Soal Apa?
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row px-3">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href={{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }} class="border">
                                    <p class="text-muted mb-0">Pilihan Ganda</p>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ] ) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Pilihan Ganda
                                </a>
                                <div class="mt-2 d-flex flex-column">
                                    <p class="text-muted fw-1 mb-0">Seleksi</p>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Benar Salah Ganda</a>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Benar Salah</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-2 d-flex flex-column">
                                    <p class="text-muted fw-1 mb-0">Mengurutkan</p>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Mengategorikan</a>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Menyusun Pembuktian</a>
                                </div>
                                <div class="mt-2 d-flex flex-column">
                                    <p class="text-muted fw-1 mb-0">Menyelesaikan</p>
                                    <a  href="{{ route('pustaka.kuis.editor', ['isianSingkat',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Isian Singkat</a>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Isian Matematis</a>
                                    <a  href="{{ route('pustaka.kuis.editor', ['pilihanGanda',$var[0]->kuis_code ]) }}" class="mb-2"><i class="fa-solid fa-list-ul"></i>  Cloze Procedure</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card rounded" style="background-color:#f2f7ff">
                            <div class="card-header">Pilihan Ganda</div>
                            <div class="card-body">
                                <img src="{{ asset('images/quiz-picture.png') }}"
                                class="card-img rounded-4" alt="" srcset="">
                                <p class="text-center mt-3">Soal berupa instruksi dan 4 atau lebih pilihan 
                                    jawaban yang bisa di pilih oleh peserta kuis.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
