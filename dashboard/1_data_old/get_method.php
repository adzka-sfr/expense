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
    $exception = $_POST['exception'] ?? null;
    $username = $user['username'];
    $status = 'active';

    if ($exception) {
        $stmt = $connect->prepare("SELECT id, c_name FROM t_payment WHERE c_username = :username AND c_status = :statuse AND id != :exception");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':statuse', $status);
        $stmt->bindParam(':exception', $exception);
    } else {
        $stmt = $connect->prepare("SELECT id, c_name FROM t_payment WHERE c_username = :username AND c_status = :statuse");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':statuse', $status);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $options = "<option value=''>Select a category</option>";
    foreach ($result as $row) {
        $options .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['c_name']) . "</option>";
    }

    echo $options;

    $stmt = null;
    $connect = null;
}
