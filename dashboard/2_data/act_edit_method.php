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
    $methodId = $_POST['methodId'];
    $methodName = $_POST['methodName'];
    $methodStatus = $_POST['methodStatus'];
    $retainCapital = $_POST['retainCapital'];

    // change all characters to lowercase
    if ($retainCapital == "true") {
        $methodName = $methodName;
    } else {
        $methodName = ucwords(strtolower($methodName));
    }
    $methodStatus = $methodStatus == "true" ? "active" : "inactive";
    $username = $user['username'];

    // check the category name and type in database
    $stmt = $connect->prepare("UPDATE t_payment SET c_name = :methodName, c_status = :methodStatus WHERE id = :methodId");
    $stmt->bindParam(':methodName', $methodName);
    $stmt->bindParam(':methodStatus', $methodStatus);
    $stmt->bindParam(':methodId', $methodId);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "failed";
    }
}
