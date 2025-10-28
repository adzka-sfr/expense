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
    $username = $user['username'];
    $month = $_POST['month'] ?? date('Y-m', strtotime($now));
    $month = date('Y-m', strtotime($month));

    // Prepare the SQL query
    $stmt = $connect->prepare("SELECT COUNT(*) AS total FROM t_outcome WHERE c_username = :username AND DATE_FORMAT(c_datetime, '%Y-%m') = :month
            ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':month', $month);
    $stmt->execute();

    // Fetch result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['total'] > 0) {
        $stmt = $connect->prepare("SELECT SUM(c_nominal) AS total FROM t_outcome WHERE c_username = :username AND DATE_FORMAT(c_datetime, '%Y-%m') = :month");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $row['total'];
    } else {
        echo 0;
    }


    // Close PDO connection
    $connect = null;
}
