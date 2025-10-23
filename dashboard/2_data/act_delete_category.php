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

    // get data post
    $catId = $_POST['catId'];

    // check is the category used in t_transaction
    $stmt = $connect->prepare("SELECT COUNT(*) FROM t_outcome WHERE c_category = :catId");
    $stmt->bindParam(':catId', $catId, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "used";
    } else {
        // delete the category from t_budget
        $stmt = $connect->prepare("DELETE FROM t_budget WHERE c_category = :catId");
        $stmt->bindParam(':catId', $catId, PDO::PARAM_INT);
        $stmt->execute();

        // delete the category from t_category
        $stmt = $connect->prepare("DELETE FROM t_category WHERE id = :catId");
        $stmt->bindParam(':catId', $catId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
