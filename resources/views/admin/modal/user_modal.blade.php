<div class="modal fade" id="user_form" tabindex="-1" aria-labelledby="user_form" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="user_form_title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user_form_action">

                    <div class="mb-3">
                        <label for="email" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="nama anda">
                        <div class="invalid-feedback" id="nama_validation">
                            sudah benar!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="name@example.com">
                        <div class="invalid-feedback" id="email_validation">
                            sudah benar!
                        </div>
                    </div>

                    <label for="passwprd" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" name="password"
                        aria-describedby="passwordHelpBlock">
                    <div id="passwordHelpBlock" class="form-text">
                        Buat password dengan 8 karakter atau lebih.
                    </div>
                    <div class="invalid-feedback" id="password_validation">
                        sudah benar!
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="user_add_button">Tambah</button>
                <button type="button" class="btn btn-primary d-none" id="user_edit_button">Simpan</button>
            </div>
        </div>
    </div>
</div>
