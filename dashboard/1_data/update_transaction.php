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
    $category = $_POST['category'];
    $methode = $_POST['methode'];
    $statuse = $_POST['statuse'];
    $nominal = $_POST['nominal'];
    $detail = $_POST['detail'];
    $time = $_POST['time'];

    $username = $user['username'];

    if ($statuse === 'pengeluaran') {
        $query = "UPDATE t_outcome SET c_nominal = :nominal, c_detail = :detail, c_datetime = :timen, c_category = :category, c_payment = :methode WHERE id = :id";
    } else {
        $query = "UPDATE t_income SET c_nominal = :nominal, c_detail = :detail, c_datetime = :timen, c_category = :category, c_payment = :methode WHERE id = :id";
    }

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':nominal', $nominal, PDO::PARAM_STR);
    $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindParam(':timen', $time, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':methode', $methode, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
