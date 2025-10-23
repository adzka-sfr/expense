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
?>