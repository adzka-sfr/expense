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
    $id = $_POST['id'];

    $query = "DELETE FROM t_outcome WHERE id = :id";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
