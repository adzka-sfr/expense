<div class="card mt-5">
    <div class="card-header text-center">
        <h4>Daftar ke Duit <sub style="font-size: 0.3em;">by Adzka</sub></h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
            <small class="text-danger" id="username-error" style="display: none;">Username wajib diisi</small>
            <small class="text-danger" id="username-exist" style="display: none;">Username sudah ada, coba yang lain</small>
        </div>
        <div class="form-group mt-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <small class="text-danger" id="password-error" style="display: none;">Password wajib diisi</small>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-3">
                <button class="btn btn-primary btn-block" id="register">Daftar</button>
            </div>
        </div>
        <div class="form-group text-center mt-3">
            <a href="main.php?page=login">Sudah punya akun ? Masuk disini</a>
        </div>
    </div>
</div>