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
    $catId = $_POST['catId'];
    $catName = $_POST['catName'];
    $catStatus = $_POST['catStatus'];
    $retainCapital = $_POST['retainCapital'];
    $icon = $_POST['catIcon'] ?? null;

    // change all characters to lowercase
    if ($retainCapital == "true") {
        $catName = $catName;
    } else {
        $catName = ucwords(strtolower($catName));
    }
    $catStatus = $catStatus == "true" ? "active" : "inactive";
    $username = $user['username'];

    // prepare SQL query
    if ($icon !== null) {
        $stmt = $connect->prepare("UPDATE t_category SET c_name = :catName, c_status = :catStatus, c_icon = :catIcon WHERE id = :catId");
        $stmt->bindParam(':catIcon', $icon);
    } else {
        $stmt = $connect->prepare("UPDATE t_category SET c_name = :catName, c_status = :catStatus WHERE id = :catId");
    }
    $stmt->bindParam(':catName', $catName);
    $stmt->bindParam(':catStatus', $catStatus);
    $stmt->bindParam(':catId', $catId);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "failed";
    }
}
