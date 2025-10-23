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
    $nominal = $_POST['nominal'];

    // update data
    try {
        $stmt = $connect->prepare("UPDATE t_budget SET c_budget = :nominal, c_datetime = :datetimenya WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':datetimenya', $now);
        $stmt->bindParam(':nominal', $nominal);
        $stmt->execute();
        echo "success";
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
