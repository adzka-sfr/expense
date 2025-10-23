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

    // delete data
    try {
        $stmt = $connect->prepare("DELETE FROM t_budget WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "success";
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
