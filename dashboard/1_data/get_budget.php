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
    $time = $_POST['time'] ?? null;
    $username = $user['username'];

    if (!empty($time)) {
        $month = date('Y-m', strtotime($time));

        if ($category !== null) {
            // Prepare the SQL query
            // Get budget by username, category, and month
            $stmt = $connect->prepare("SELECT 
                    COALESCE(c_budget, 0) as c_budget 
                FROM 
                    t_budget 
                WHERE 
                    c_username = :username 
                AND 
                    c_category = :category 
                AND 
                    c_month = :month
            ");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':month', $month);
            $stmt->execute();
            $budgetRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $budget = $budgetRow['c_budget'] ?? 0;

            // Get total outcome by username, category, and month
            $stmt = $connect->prepare("SELECT 
                    COALESCE(SUM(c_nominal), 0) as total_nominal 
                FROM 
                    t_outcome 
                WHERE 
                    c_username = :username 
                AND 
                    c_category = :category 
                AND 
                    DATE_FORMAT(c_datetime, '%Y-%m') = :month
            ");
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':month', $month);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $total_nominal = $row['total_nominal'];
                $remaining = $budget - $total_nominal;

                echo $remaining;
            } else {
                echo 0;
            }
        } else {
            echo '';
        }
    } else {
        echo "Silahkan pilih waktu";
    }

    // Close PDO connection
    $connect = null;
}
