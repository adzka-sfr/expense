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
    $color = $_POST['color'];
    $username = $user['username'];

    // update the theme in t_auth table for the given username
    $stmt = $connect->prepare("UPDATE t_auth SET c_theme = :color WHERE c_username = :username");
    $stmt->bindParam(':color', $color);
    $stmt->bindParam(':username', $username);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "failed";
    }
}
