<div class="modal fade" id="form_create_quiz" tabindex="-1" aria-labelledby="form-peserta" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_kuis">Buat Kuis Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <form id="form_buat_kuis">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="idIn">
                            @csrf
                           
                            <div class="form-group">
                                <label for="judul_kuis">Judul Kuis </label>
                                <input id="judul_kuis" name="judul_kuis" type="text" placeholder="Judul Kuis"
                                    class="form-control" />
                                    <div class="" id="judul_kuis_field">
    
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="judul_kuis">Mata Pelajaran </label>
                                <select name="mata_pelajaran" id="mata_pelajaran" class="form-select" aria-label="Default select example">]
                                    <option value="" selected disabled>Pilih Mata Pelajaran</option>
                                    <option value="Pendidikan Kewarganegaraan">Pendidikan Kewarganegaraan</option>
                                    <option value="Pendidikan Agama">Pendidikan Agama</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="Bahasa Indonesia">Bahasa indnesia</option>
                                    <option value="Fisika">FIsika</option>
                                    <option value="Biologi">Biologi</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="PPKN">PPKN</option>
                                    <option value="Informatika">Informatika</option>
                                    <option value="TIK">TIK</option>
                                  </select>
                                  <div class="" id="mata_pelajaran_field">
    
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="judul_kuis">Tingkatan </label>
                                <select name="tingkatan" id="tingkatan_kuis"class="form-select" aria-label="Default select example">
                                    <option value="" selected disabled>Pilih Tingkat</option>
                                    <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                                    <option value="SMK">SMK</option>
                                    <option value="SMA">SMA</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SD">SD</option>
                                    <option value="TK">TK</option>
                                    <option value="PAUD">Paud</option>
                                  </select>
                                  <div class="" id="tingkatan_kuis_field">
    
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="">Upload Baner Kuis Disini</label>
                        <input class="form-control" name="avatar" type="file" id="banner">
                        <img src="{{ asset("images/quiz-picture.png") }}" id="image_preview" alt="mdo" style="width: 200px;"
                        class="image-preview mt-2">
                        <input type="hidden" id="file_name" name="file_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary"  id="tambah-peserta">Buat Kuis</button>
            </div>
            </form>
        </div>
    </div>
</div>
