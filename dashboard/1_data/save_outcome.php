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

    // Get data from POST request
    $time = $_POST['time'] ?? null;
    $category = $_POST['category'] ?? null;
    $nominal = $_POST['nominal'] ?? null;
    $detail = $_POST['detail'] ?? null;
    $time = date('Y-m-d H:i:s', strtotime($time));

    $username = $user['username'];

    // Prepare SQL statement
    $sql = "INSERT INTO t_outcome (c_category, c_nominal, c_detail, c_datetime, c_username) 
            VALUES (:category, :nominal, :detail, :waktu, :username)";

    // Prepare the statement
    $stmt = $connect->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':category', $category, PDO::PARAM_INT);
    $stmt->bindParam(':nominal', $nominal, PDO::PARAM_STR);
    $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindParam(':waktu', $time, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    // Execute the statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
