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

    // get data post
    $month = $_POST['month'];
    $month = date('Y-m', strtotime($month));
    $last_month = date('Y-m', strtotime('-1 month', strtotime($month)));

    try {
        // Second query to get monthly comparison data
        $stmt = $connect->prepare("SELECT 
                            curr.c_username,
                            curr.c_month AS c_this_month,

                            -- Sum of all balances up to the last month
                            (SELECT COALESCE(SUM(c_balance), 0) 
                            FROM `v_monthly_balance` 
                            WHERE c_username = curr.c_username 
                            AND c_month <= :last_month) AS c_last_month_balance,

                            -- Sum of all balances up to this month
                            (SELECT COALESCE(SUM(c_balance), 0) 
                            FROM `v_monthly_balance` 
                            WHERE c_username = curr.c_username 
                            AND c_month <= :monthe) AS c_this_month_balance,

                            -- Difference calculation
                            ((SELECT COALESCE(SUM(c_balance), 0) 
                            FROM `v_monthly_balance` 
                            WHERE c_username = curr.c_username 
                            AND c_month <= :monthe)
                            - 
                            (SELECT COALESCE(SUM(c_balance), 0) 
                            FROM `v_monthly_balance` 
                            WHERE c_username = curr.c_username 
                            AND c_month <= :last_month)
                            ) AS c_difference

                            FROM `v_monthly_balance` curr
                            WHERE c_month = :monthe
                            AND curr.c_username = :username;
                                                    ");

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':last_month', $last_month, PDO::PARAM_STR);
        $stmt->bindParam(':monthe', $month, PDO::PARAM_STR);
        $stmt->execute();
        $comparison_result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fix JSON output keys
        if ($comparison_result) {
            echo json_encode([
                'last_month_balance' => $comparison_result['c_last_month_balance'],
                'this_month_balance' => $comparison_result['c_this_month_balance'], // Fix
                'difference' => $comparison_result['c_difference']
            ]);
        } else {
            echo json_encode([
                'last_month_balance' => 0,
                'this_month_balance' => 0,
                'difference' => 0
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
