<?php
// check cookie
$jwt = $_COOKIE['expense_token'] ?? null;
if ($jwt === null) {
    echo "cookie_expired";
} else {
    // Auto-detect if running on localhost or domain
    $is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;
    if ($is_localhost) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/connect.php'; // local
        require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/check_cookie.php'; // local
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/check_cookie.php'; // hosting
    }

    // Get data from POST request
    $payment = $_POST['methode'] ?? null;
    $username = $user['username'];


    if ($payment !== null) {
        // Prepare the SQL query
        $stmt = $connect->prepare("SELECT 
            COALESCE((SELECT SUM(c_nominal) FROM t_outcome WHERE c_username = :username AND c_payment = :payment), 0) as total_outcome_nominal,
            COALESCE((SELECT SUM(c_nominal) FROM t_income WHERE c_username = :username AND c_payment = :payment), 0) as total_income_nominal
            ");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':payment', $payment);
        $stmt->execute();

        // Fetch result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $total_outcome_nominal = $row['total_outcome_nominal'];
            $total_income_nominal = $row['total_income_nominal'];
            $saldo = $total_income_nominal - $total_outcome_nominal;

            echo $saldo;
        } else {
            echo 0;
        }
    } else {
        echo '';
    }


    // Close PDO connection
    $connect = null;
}
