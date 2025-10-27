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

    $username = $user['username'];
    $month = date('Y-m', strtotime($now));
    $last_month = date('Y-m', strtotime('-1 month', strtotime($now)));

    try {
        // First query to get total_balance
        $stmt = $connect->prepare("SELECT SUM(c_total) as total_balance FROM v_balance WHERE c_username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_balance = $result ? $result['total_balance'] : 0;

        // Second query to get monthly comparison data
        $stmt1 = $connect->prepare("SELECT SUM(c_balance) AS c_last_month_balance
                            FROM `v_monthly_balance` 
                            WHERE c_username = :username 
                            AND c_month <= :last_month");

        $stmt1->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt1->bindParam(':last_month', $last_month, PDO::PARAM_STR);
        $stmt1->execute();
        $last_month = $stmt1->fetch(PDO::FETCH_ASSOC);
        $last_month_balance = $last_month && isset($last_month['c_last_month_balance']) ? $last_month['c_last_month_balance'] : 0;

        $stmt2 = $connect->prepare("SELECT SUM(c_balance) AS c_this_month_balance
                            FROM `v_monthly_balance` 
                            WHERE c_username = :username 
                            AND c_month <= :month");

        $stmt2->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt2->bindParam(':month', $month, PDO::PARAM_STR);
        $stmt2->execute();
        $this_month = $stmt2->fetch(PDO::FETCH_ASSOC);
        $this_month_balance = $this_month && isset($this_month['c_this_month_balance']) ? $this_month['c_this_month_balance'] : 0;

        // Fix JSON output keys
        echo json_encode([
            'kekayaan' => $total_balance,
            'last_month_balance' => $last_month_balance,
            'this_month_balance' => $this_month_balance
        ]);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
