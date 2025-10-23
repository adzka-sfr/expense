<?php
// check cookie
$jwt = $_COOKIE['expense_token'] ?? null;
if ($jwt === null) {
    echo "cookie_expired";
} else {
    // Auto-detect if running on localhost or domain
    $is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;
    if ($is_localhost) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/connect.php'; // local
        require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/check_cookie.php'; // local
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/check_cookie.php'; // hosting
    }

    // get data post
    $newPassword = $_POST['newPassword'];
    $oldPassword = $_POST['oldPassword'];

    $username = $user['username'];

    // check if the old password is correct
    $stmt = $connect->prepare("SELECT c_password FROM t_auth WHERE c_username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($oldPassword, $result['c_password'])) {
        // update the password in t_auth table for the given username
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $connect->prepare("UPDATE t_auth SET c_password = :newPassword WHERE c_username = :username");
        $stmt->bindParam(':newPassword', $newPasswordHash);
        $stmt->bindParam(':username', $username);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "password-error";
    }
}
