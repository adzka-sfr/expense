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
    $catName = $_POST['catName'];
    $catType = $_POST['catType'];
    $retainCapital = $_POST['retainCapital'];
    $icon = $_POST['icon'];

    // change all characters to lowercase
    if ($retainCapital == "true") {
        $catName = $catName;
    } else {
        $catName = ucwords(strtolower($catName));
    }
    $username = $user['username'];
    $statuse = "active";

    // check the category name and type in database
    $check = $connect->prepare("SELECT * FROM t_category WHERE c_name = :catName AND c_type = :catType AND c_username = :username");
    $check->bindParam(':catName', $catName);
    $check->bindParam(':catType', $catType);
    $check->bindParam(':username', $username);
    $check->execute();
    if ($check->rowCount() > 0) {
        echo "exist";
    } else {
        $stmt = $connect->prepare("INSERT INTO t_category (c_name, c_type, c_username, c_datetime, c_status, c_icon) VALUES (:catName, :catType, :username, :cDatetime, :cStatus, :cIcon)");
        $stmt->bindParam(':catName', $catName);
        $stmt->bindParam(':catType', $catType);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':cDatetime', $now);
        $stmt->bindParam(':cStatus', $statuse);
        $stmt->bindParam(':cIcon', $icon);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
