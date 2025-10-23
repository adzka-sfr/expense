<?php
// check cookie
$jwt = $_COOKIE['duit_token'] ?? null;
if ($jwt === null) {
    echo "cookie_expired";
} else {
    // require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/config/connect.php'; // local
    // require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/config/check_cookie.php'; // local
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/check_cookie.php'; // hosting

    // get data post
    $id = $_POST['id'];
    $statuse = $_POST['statuse'];
    $username = $user['username'];

    if ($statuse === 'pengeluaran') {
        $query = "DELETE FROM t_outcome WHERE id = :id";
    } else {
        $query = "DELETE FROM t_income WHERE id = :id";
    }

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
