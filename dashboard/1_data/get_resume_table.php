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
    $username = $user['username'];
    $month = date('Y-m', strtotime($now));

    $query = "SELECT b.c_name AS c_category, SUM(a.c_nominal) AS c_total FROM t_outcome a INNER JOIN t_category b ON a.c_category = b.id
                WHERE a.c_username = :username AND DATE_FORMAT(a.c_datetime, '%Y-%m') = :monthe
                GROUP BY b.c_name ORDER BY c_total DESC";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':monthe', $month);
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_nominal = 0;
    foreach ($transactions as $transaction) {
        $total_nominal += $transaction['c_total'];
    }

    if ($total_nominal == 0) {
        exit();
    }
?>
    <table style="font-size: 0.7em;">
        <?php foreach ($transactions as $transaction):
            $percentage = ($transaction['c_total'] / $total_nominal) * 100;
        ?>
            <tr>
                <td style="text-align: right; width: 10%;"><?php echo '(' . number_format($percentage, 1) . '%)'; ?></td>
                <td style="text-align: center;">-</td>
                <td><?php echo htmlspecialchars($transaction['c_category']); ?></td>
                <td style="text-align: right;"><?php echo number_format($transaction['c_total'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php
    // Close PDO connection
    $connect = null;
}
