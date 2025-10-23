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

    // get data post
    $type = $_POST['type'];
    $month = $_POST['monthe'];
    $month = date('Y-m', strtotime($month));

    $username = $user['username'];
    $status = 'active';

    $stmt = $connect->prepare("SELECT id, c_name FROM t_category WHERE c_username = :username AND c_type = :type AND c_status = :statuse AND id NOT IN (SELECT c_category FROM t_budget WHERE c_username = :username AND c_month = :monthe)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':statuse', $status);
    $stmt->bindParam(':monthe', $month);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $options = "<option value=''>Pilih salah satu</option>";
    foreach ($result as $row) {
        $options .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['c_name']) . "</option>";
    }

    echo $options;

    $stmt = null;
    $connect = null;
}
