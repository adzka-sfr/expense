<div class="card mt-5">
    <div class="card-header text-center">
        <h4>Masuk ke Duit <sub style="font-size: 0.3em;">by Adzka</sub></h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
            <small class="text-danger" id="username-error" style="display: none;">Username wajib diisi</small>
            <small class="text-danger" id="username-not-exist" style="display: none;">Username tidak terdaftar</small>
        </div>
        <div class="form-group mt-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <small class="text-danger" id="password-error" style="display: none;">Password salah</small>
        </div>
        <div class="form-group mt-3">
            <a href="main.php?page=reset">Lupa akun ? reset disini</a>
        </div>
        <div class="row">
            <div class="col-12 mt-3 text-center">
                <button class="btn btn-primary btn-block" id="login">Masuk</button>
            </div>
        </div>
        <div class="form-group text-center mt-3">
            <a href="main.php?page=register">User baru? Daftar disini</a>
        </div>

        <div class="form-group text-center mt-3" style="font-size: 0.8em;">
           Application Owner <br><a href="https://adzkasfr.com">Adzka SFR</a>
        </div>
    </div>
</div>