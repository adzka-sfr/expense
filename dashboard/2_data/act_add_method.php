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
    $methodName = $_POST['methodName'];
    $retainCapital = $_POST['retainCapital'];

    // change all characters to lowercase
    if ($retainCapital == "true") {
        $methodName = $methodName;
    } else {
        $methodName = ucwords(strtolower($methodName));
    }

    $username = $user['username'];
    $statuse = "active";

    // check the category name and type in database
    $check = $connect->prepare("SELECT * FROM t_payment WHERE c_name = :catName AND c_username = :username");
    $check->bindParam(':catName', $methodName);
    $check->bindParam(':username', $username);
    $check->execute();
    if ($check->rowCount() > 0) {
        echo "exist";
    } else {
        $stmt = $connect->prepare("INSERT INTO t_payment (c_name, c_username, c_datetime, c_status) VALUES (:catName, :username, :cDatetime, :cStatus)");
        $stmt->bindParam(':catName', $methodName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':cDatetime', $now);
        $stmt->bindParam(':cStatus', $statuse);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
