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

    try {
        $stmt = $connect->prepare("SELECT c_name, c_code FROM t_icon ORDER BY c_name ASC");
        $stmt->execute();
        $icons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<option value="">Select an icon</option>';
        foreach ($icons as $icon) {
            echo '<option value="' . htmlspecialchars($icon['c_code']) . '">' . htmlspecialchars($icon['c_name']) . '</option>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
