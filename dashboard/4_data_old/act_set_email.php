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
    $email = $_POST['email'];
    $username = $user['username'];

    // check if the email is already used
    $checkStmt = $connect->prepare("SELECT COUNT(*) FROM t_auth WHERE c_email = :email");
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();
    $emailCount = $checkStmt->fetchColumn();

    if ($emailCount > 0) {
        echo "email-exist";
    } else {
        // update the email in t_auth table for the given username
        $stmt = $connect->prepare("UPDATE t_auth SET c_email = :email WHERE c_username = :username");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
