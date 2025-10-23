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
    $month = $_POST['month'];
    $cat = $_POST['cat'];
    $nominal = $_POST['nominal'];

    $username = $user['username'];

    // insert data
    try {
        $stmt = $connect->prepare("INSERT INTO t_budget (c_category, c_username, c_budget, c_month, c_datetime) VALUES (:cat, :username, :nominal, :monthe, :datetimenya)");
        $stmt->bindParam(':monthe', $month);
        $stmt->bindParam(':datetimenya', $now);
        $stmt->bindParam(':cat', $cat);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':nominal', $nominal);
        $stmt->execute();
        echo "success";
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
