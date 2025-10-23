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
    $from = $_POST['from'] ?? null;
    $to = $_POST['to'] ?? null;
    $nominal = $_POST['nominal'] ?? null;
    $time = $_POST['time'] ?? null;
    $time = date('Y-m-d H:i:s', strtotime($time));

    // create nominal minus
    $nominal_minus = $nominal * -1;

    $username = $user['username'];
    $detail = strtotime($time);

    // Prepare SQL statement for 'from' (pengurangan saldo)
    $sql_from = "INSERT INTO t_income (c_category, c_payment, c_nominal, c_detail, c_datetime, c_username) 
                 VALUES (0, :methode, :nominal_minus, :detail, :timen, :username)";

    // Prepare the statement for 'from'
    $stmt_from = $connect->prepare($sql_from);

    // Bind parameters for 'from'
    $stmt_from->bindParam(':methode', $from, PDO::PARAM_INT);
    $stmt_from->bindParam(':nominal_minus', $nominal_minus, PDO::PARAM_STR);
    $stmt_from->bindParam(':detail', $detail, PDO::PARAM_STR);
    $stmt_from->bindParam(':timen', $time, PDO::PARAM_STR);
    $stmt_from->bindParam(':username', $username, PDO::PARAM_STR);

    // Execute the statement for 'from'
    if (!$stmt_from->execute()) {
        echo "error";
        exit;
    }

    // Prepare SQL statement for 'to' (penambahan saldo)
    $sql_to = "INSERT INTO t_income (c_category, c_payment, c_nominal, c_detail, c_datetime, c_username) 
               VALUES (0, :methode, :nominal, :detail, :timen, :username)";

    // Prepare the statement for 'to'
    $stmt_to = $connect->prepare($sql_to);

    // Bind parameters for 'to'
    $stmt_to->bindParam(':methode', $to, PDO::PARAM_INT);
    $stmt_to->bindParam(':nominal', $nominal, PDO::PARAM_STR);
    $stmt_to->bindParam(':detail', $detail, PDO::PARAM_STR);
    $stmt_to->bindParam(':timen', $time, PDO::PARAM_STR);
    $stmt_to->bindParam(':username', $username, PDO::PARAM_STR);

    // Execute the statement for 'to'
    if (!$stmt_to->execute()) {
        echo "error";
        exit;
    }

    // If both statements executed successfully
    echo "success";
}
