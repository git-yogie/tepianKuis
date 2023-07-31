<div class="modal fade" tabindex="-1" role="dialog"
id="masuk">
<div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
            <h1 class="fw-bold mb-0 fs-2">Masuk</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-5 pt-0">
            <form id="signInForm">
                 @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email"  class="form-control rounded-3" id="email"
                        placeholder="email@example.com" required>
                    <label for="floatingInput">Alamat Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-3" id="password"
                        placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" id="signInBtn" type="submit">Masuk</button>
                <div class="text-muted">Belum Punya akun? <a href="#">Daftar Sekarang!</a></div>
            </form>
        </div>
    </div>
</div>
<div id="toastContainer" class="position-fixed bottom-0 end-0 p-3"></div>