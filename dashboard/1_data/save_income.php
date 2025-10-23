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

    // Get data from POST request
    $category = $_POST['category'] ?? null;
    $methode = $_POST['methode'] ?? null;
    $nominal = $_POST['nominal'] ?? null;
    $detail = $_POST['detail'] ?? null;
    $time = $_POST['time'] ?? null;
    $time = date('Y-m-d H:i:s', strtotime($time));

    $username = $user['username'];

    // Prepare SQL statement
    $sql = "INSERT INTO t_income (c_category, c_payment, c_nominal, c_detail, c_datetime, c_username) 
            VALUES (:category, :methode, :nominal, :detail, :timen, :username)";
    
    // Prepare the statement
    $stmt = $connect->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':category', $category, PDO::PARAM_INT);
    $stmt->bindParam(':methode', $methode, PDO::PARAM_INT);
    $stmt->bindParam(':nominal', $nominal, PDO::PARAM_STR);
    $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindParam(':timen', $time, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
