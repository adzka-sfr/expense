<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/config/connect.php'; // local
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting

// require $_SERVER['DOCUMENT_ROOT'] . '/duit/assets/PHPMailer/src/PHPMailer.php'; // local
// require $_SERVER['DOCUMENT_ROOT'] . '/duit/assets/PHPMailer/src/Exception.php'; // local
// require $_SERVER['DOCUMENT_ROOT'] . '/duit/assets/PHPMailer/src/SMTP.php'; // local

require $_SERVER['DOCUMENT_ROOT'] . '/assets/PHPMailer/src/PHPMailer.php'; // hosting
require $_SERVER['DOCUMENT_ROOT'] . '/assets/PHPMailer/src/Exception.php'; // hosting
require $_SERVER['DOCUMENT_ROOT'] . '/assets/PHPMailer/src/SMTP.php'; // hosting

// get data post
$email = $_POST['email'];
$register_time = date('Y-m-d H:i:s', strtotime($now));

// check if email already exists
$sql = "SELECT * FROM t_auth WHERE c_email = :email";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo 'email-not-exist';
    echo json_encode(array('status' => 'email-not-exist'));
    exit;
} else {
    // Check if the last email was sent more than 1 hour ago
    $last_email_time = strtotime($result['c_datetime_email']);
    $current_time = strtotime($now);
    $time_diff = $current_time - $last_email_time;

    if ($time_diff <= 3600) {
        $next_available_time = date('Y-m-d H:i:s', $last_email_time + 3600);
        echo json_encode(array('status' => 'to-much', 'next_time' => $next_available_time));
    } else {
        // Generate new password
        $c_username = $result['c_username'];
        $new_password = $c_username . '_' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $now = date('Y-m-d H:i:s', strtotime($now));

        // Update password in the database
        $update_sql = "UPDATE t_auth SET c_password = :hashed_password, c_datetime_email = :nowe WHERE c_email = :emaile";
        $update_stmt = $connect->prepare($update_sql);
        $update_stmt->bindParam(':hashed_password', $hashed_password);
        $update_stmt->bindParam(':nowe', $now);
        $update_stmt->bindParam(':emaile', $email);

        // Send email to user
        if ($update_stmt->execute()) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'information_system@duit.adzkasfr.com';                     // SMTP username
                $mail->Password   = 'Alfianwai1!';                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('information_system@duit.adzkasfr.com', 'TEAM DUIT');
                $mail->addAddress($email);     // Add a recipient
                $mail->addReplyTo("information_system@duit.adzkasfr.com", 'TEAM DUIT');

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Informasi Login DUIT';
                $mail->Body    = 'Hallo, Semangat menabung !<br> Berikut akses ke <b>DUIT</b> kamu<br> Username : <b>' . $c_username . '</b></br> Password : <b>' . $new_password . '</b></br> </br> Mohon untuk tidak memberitahukan informasi tersebut kepada orang lain, dan segera ubah password anda!</br> Salam, <br><b>Adzka SFR (CEO DUIT)</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo json_encode(array('status' => 'success'));
            } catch (Exception $e) {
                $error_message = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                echo json_encode(array('status' => 'failed', 'info' => $error_message));
            }
        } else {
            echo json_encode(array('status' => 'failed', 'info' => 'Failed to update password in database'));
        }
    }
}
