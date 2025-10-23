<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/config/connect.php'; // local
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting

$user = require_once base_path('config/check_cookie.php');

// If the user is already authenticated, redirect them to the dashboard
if ($user) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duit</title>
    <link rel="icon" href="<?php echo base_url('assets/images/robot_face.png'); ?>" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body style="background-color: #D6F3FB;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (empty($_GET['page'])) {
                    $_GET['page'] = "login";
                } else {
                    include "content.php";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#register').click(function() {
                var username = $('#username').val();
                var password = $('#password').val();

                // Reset error messages
                $('#username-error').hide();
                $('#password-error').hide();

                // Validate inputs
                var isValid = true;
                if (username === '') {
                    $('#username-error').show();
                    isValid = false;
                }
                if (password === '') {
                    $('#password-error').show();
                    isValid = false;
                }

                if (isValid) {
                    $('#username').prop('disabled', true);
                    $('#password').prop('disabled', true);
                    $('#register').prop('disabled', true);
                    $('#register').html('Loading...');
                    $.ajax({
                        url: '<?php echo base_url('auth/act_register.php'); ?>',
                        type: 'POST',
                        data: {
                            username,
                            password
                        },
                        success: function(response) {
                            $('#username').prop('disabled', false);
                            $('#password').prop('disabled', false);
                            $('#register').prop('disabled', false);
                            $('#register').html('Register');
                            var response = JSON.parse(response);
                            console.log(response.status);

                            if (response.status == 'success') {
                                Swal.fire({
                                    title: 'Registrasi berhasil!',
                                    text: 'Silahkan login untuk melanjutkan',
                                    icon: 'success',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then(function() {
                                    window.location = '<?php echo base_url('auth/'); ?>';
                                });
                            } else if (response.status == 'username_exist') {
                                $('#username-exist').show();
                            } else if (response.status == 'email_exist') {
                                $('#email-exist').show();
                            } else {
                                Swal.fire({
                                    title: 'Registration gagal!',
                                    text: 'Silahkan coba lagi.',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                });
                            }
                        }
                    });
                }
            });

            $('#login').click(function() {
                var username = $('#username').val();
                var password = $('#password').val();

                // Reset error messages
                $('#username-error').hide();
                $('#username-not-exist').hide();
                $('#password-error').hide();

                // Validate inputs
                var isValid = true;
                if (username === '') {
                    $('#username-error').show();
                    isValid = false;
                }
                if (password === '') {
                    $('#password-error').show();
                    isValid = false;
                }

                if (isValid) {
                    $('#username').prop('disabled', true);
                    $('#password').prop('disabled', true);
                    $('#login').prop('disabled', true);
                    $('#login').html('Loading...');
                    $.ajax({
                        url: '<?php echo base_url('auth/act_login.php'); ?>',
                        type: 'POST',
                        data: {
                            username,
                            password
                        },
                        success: function(response) {
                            $('#username').prop('disabled', false);
                            $('#password').prop('disabled', false);
                            $('#login').prop('disabled', false);
                            $('#login').html('Login');
                            if (response == 'success') {
                                window.location = '<?php echo base_url('dashboard'); ?>';
                            } else if (response == 'username-not-exist') {
                                $('#username-not-exist').show();
                                $('#username').focus();
                            } else if (response == 'password-error') {
                                $('#password-error').show();
                                $('#password').focus();
                            } else {
                                alert('Failed to login. Please try again.');
                            }
                        }
                    });
                }
            });

            $('#username').keypress(function(e) {
                if (e.which == 13) { // Enter key pressed
                    $('#password').focus();
                }
            });

            $('#password').keypress(function(e) {
                if (e.which == 13) { // Enter key pressed
                    if ($('#register').is(':visible')) {
                        $('#register').click();
                    } else if ($('#login').is(':visible')) {
                        $('#login').click();
                    }
                }
            });

            $('#email').keypress(function(e) {
                if (e.which == 13) { // Enter key pressed
                    $('#reset-akun').click();
                }
            });

            $('#reset-akun').click(function() {
                var email = $('#email').val();

                // Reset error messages
                $('#email-error').hide();
                $('#email-not-exist').hide();

                // Validate inputs
                var isValid = true;
                if (email === '') {
                    $('#email-error').show();
                    isValid = false;
                }

                if (isValid) {
                    $('#email').prop('disabled', true);
                    $('#reset-akun').prop('disabled', true);
                    $('#reset-akun').html('Loading...');
                    $.ajax({
                        url: '<?php echo base_url('auth/act_reset.php'); ?>',
                        type: 'POST',
                        data: {
                            email
                        },
                        success: function(response) {
                            $('#email').prop('disabled', false);
                            $('#reset-akun').prop('disabled', false);
                            $('#reset-akun').html('Reset Akun');
                            var response = JSON.parse(response);
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: 'Reset akun berhasil!',
                                    text: 'Silahkan cek email untuk melanjutkan',
                                    icon: 'success',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then(function() {
                                    window.location = '<?php echo base_url('auth/'); ?>';
                                });
                            } else if (response.status == 'email-not-exist') {
                                $('#email-not-exist').show();
                            } else if (response.status == 'to-much') {
                                Swal.fire({
                                    title: 'Reset akun gagal!',
                                    text: 'Silahkan coba lagi pada ' + response.next_time,
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Reset akun gagal!',
                                    text: 'Silahkan coba lagi.',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- ECharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@4.9.0/dist/echarts.min.js"></script>

</body>

</html>