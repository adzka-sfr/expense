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
    $methodId = $_POST['methodId'];

    // check if the category is used in t_outcome
    $stmt = $connect->prepare("SELECT COUNT(*) FROM t_outcome WHERE c_payment = :methodId");
    $stmt->bindParam(':methodId', $methodId, PDO::PARAM_INT);
    $stmt->execute();
    $outcomeCount = $stmt->fetchColumn();

    // check if the category is used in t_income
    $stmt = $connect->prepare("SELECT COUNT(*) FROM t_income WHERE c_payment = :methodId");
    $stmt->bindParam(':methodId', $methodId, PDO::PARAM_INT);
    $stmt->execute();
    $incomeCount = $stmt->fetchColumn();

    if ($outcomeCount > 0 || $incomeCount > 0) {
        echo "used";
    } else {
        // delete the category
        $stmt = $connect->prepare("DELETE FROM t_payment WHERE id = :methodId");
        $stmt->bindParam(':methodId', $methodId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
