<div class="modal fade" id="form-peserta" tabindex="-1" aria-labelledby="form-peserta" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Tambah Peserta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="tambahPesertaForm">
                    <div class="modal-body">
                        @csrf
                        <label for="nama">Nama: </label>
                        <div class="form-group">
                            <input id="nama" name="nama" type="text" placeholder="Nama Siswa anda"
                                class="form-control" />
                                <div class="" id="nama_field">

                                </div>
                        </div>
                        <label for="nis">Nis </label>
                        <div class="form-group">
                            <input id="nis" type="number" name="nis"
                                placeholder="Nomor Induk Siswa (Jika Ada)" class="form-control" />
                                 <div class="" id="nis_field">

                                </div>
                        </div>
                        <label for="email">Email</label>
                        <div class="form-group">
                            <input id="email" type="email" name="email" placeholder="email siswa anda"
                                class="form-control" />
                                 <div class="" id="email_field">

                                </div>
                        </div>
                        <label for="kelas">Kelas</label>
                        <div class="form-group">
                            <input id="kelas" name="kelas" type="text" placeholder="Kelas"
                                class="form-control" />
                                 <div class="" id="kelas_field">

                                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary"  id="tambah-peserta">Tambah Peserta</button>
            </div>
            </form>
        </div>
    </div>
</div>
