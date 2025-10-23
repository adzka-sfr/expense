<div class="card mb-3 mt-3 mb-5" style="padding-left: 0px; padding-right: 0px; margin-bottom: 50px;">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h5 class="card-title">Pengaturan</h5>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 mt-1">
                <div class="form-group">
                    <label for="colorInput">Tema aplikasi</label>
                    <input type="color" class="form-control" id="colorInput" name="color">
                    <span id="error-cat-budget" style="font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Tema akan berdampak setelah login ulang</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: right;">
                <button class="btn btn-sm btn-primary" style="font-size: 0.7em;" id="save-theme">Update</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="colorInput">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                    <span id="error-email" style="font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Username dan Password akan dikirim ke email jika lupa</span>
                    <span id="error-email-empty" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Masukkan email jika mau update</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: right;">
                <button class="btn btn-sm btn-primary" style="font-size: 0.7em;" id="save-email">Update</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="colorInput">Password baru</label>
                    <input type="password" class="form-control" id="new-password" name="new-password">
                    <span id="error-new-password-empty" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Masukkan password baru jika mau update</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-2">
                <div class="form-group">
                    <label for="colorInput">Password lama</label>
                    <input type="password" class="form-control" id="old-password" name="old-password">
                    <span id="error-old-password-empty" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Masukkan password lama untuk update</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: right;">
                <button class="btn btn-sm btn-primary" style="font-size: 0.7em;" id="save-password">Update</button>
            </div>
        </div>
    </div>
</div>

<hr>

<script>
    $(document).ready(function() {
        getEmail();
    });

    $('#save-theme').click(function() {
        var color = $('#colorInput').val();
        $('#colorInput').prop('disabled', true);
        $('#save-theme').prop('disabled', true);

        $.ajax({
            url: '4_data/act_set_theme.php',
            type: 'POST',
            data: {
                color: color
            },
            success: function(data) {
                $('#colorInput').prop('disabled', false);
                $('#save-theme').prop('disabled', false);

                if (data == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Tema berhasil diperbarui',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Tema gagal diperbarui',
                        showConfirmButton: true
                    });
                }
            }
        });
    });

    // function to get email
    function getEmail() {
        $('#email').prop('disabled', true);
        $('#save-email').prop('disabled', true);
        $.ajax({
            url: '4_data/act_get_email.php',
            type: 'GET',
            success: function(data) {
                $('#email').prop('disabled', false);
                $('#save-email').prop('disabled', false);
                $('#email').val(data);
            }
        });
    }

    // function to save email
    $('#save-email').click(function() {
        var email = $('#email').val();
        var emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|outlook\.com|yahoo\.com)$/;

        $('#error-email-empty').hide();

        if ($.trim(email) == "") {
            $('#error-email-empty').show();
        } else if (!emailPattern.test(email)) {
            Swal.fire({
                icon: 'error',
                title: 'Email tidak valid',
                text: 'Harap masukkan email yang valid (@gmail.com, @outlook.com, @yahoo.com)',
                showConfirmButton: true
            });
        } else {
            $('#email').prop('disabled', true);
            $('#save-email').prop('disabled', true);

            $.ajax({
                url: '4_data/act_set_email.php',
                type: 'POST',
                data: {
                    email: email
                },
                success: function(data) {
                    $('#email').prop('disabled', false);
                    $('#save-email').prop('disabled', false);

                    if (data == "email-exist") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Email sudah terdaftar',
                            showConfirmButton: true
                        });
                    } else if (data == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Email berhasil diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Email gagal diperbarui',
                            showConfirmButton: true
                        });
                    }
                }
            });
        }
    });

    // function to save password
    $('#save-password').click(function() {
        var newPassword = $('#new-password').val();
        var oldPassword = $('#old-password').val();

        $('#error-new-password-empty').hide();
        $('#error-old-password-empty').hide();

        if ($.trim(newPassword) == "") {
            $('#error-new-password-empty').show();
        } else if ($.trim(oldPassword) == "") {
            $('#error-old-password-empty').show();
        } else {
            $('#new-password').prop('disabled', true);
            $('#old-password').prop('disabled', true);
            $('#save-password').prop('disabled', true);

            $.ajax({
                url: '4_data/act_set_password.php',
                type: 'POST',
                data: {
                    newPassword: newPassword,
                    oldPassword: oldPassword
                },
                success: function(data) {
                    $('#new-password').prop('disabled', false);
                    $('#old-password').prop('disabled', false);
                    $('#save-password').prop('disabled', false);
                    
                    if (data == "password-error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Password lama salah',
                            text: 'Harap masukkan password lama yang benar',
                            showConfirmButton: true
                        });
                    } else if (data == 'success') {
                        $('#new-password').val('');
                        $('#old-password').val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Password berhasil diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tema gagal diperbarui',
                            showConfirmButton: true
                        });
                    }
                }
            });
        }
    });
</script>