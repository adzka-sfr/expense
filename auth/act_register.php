<?php
// Auto-detect if running on localhost or domain
$is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
    strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

if ($is_localhost) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/connect.php'; // local
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
}

// get data post
$username = $_POST['username'];
$password = $_POST['password'];
$register_time = date('Y-m-d H:i:s', strtotime($now));

// check if username already exists
$sql = "SELECT * FROM t_auth WHERE c_username = :username";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo json_encode(array('status' => 'username_exist'));
} else {
    // Code to handle new user registration
    // check if email already exists
    $sql = "SELECT * FROM t_auth WHERE c_email = :email";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(array('status' => 'email_exist'));
    } else {
        // insert new user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO t_auth (c_username, c_password, c_email, c_datetime) VALUES (:username, :passworde, :email, :register_time)";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':passworde', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':register_time', $register_time);
        if ($stmt->execute()) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }
}
