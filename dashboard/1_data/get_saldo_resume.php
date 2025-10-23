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
    $username = $user['username'];

    $stmt = $connect->prepare("SELECT c_payment, c_payment_name, c_total FROM v_balance WHERE c_username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalSum = 0;
    foreach ($result as $row) {
        $totalSum += $row['c_total'];
    }
?>
    <div class="row">
        <?php foreach ($result as $row): ?>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label"><?php echo htmlspecialchars($row['c_payment_name']); ?></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Rp</span>
                        <input type="text" disabled class="form-control" style="text-align: right;" value="<?php echo number_format($row['c_total'], 0, '.', ','); ?>" aria-describedby="basic-addon3 basic-addon4">
                        <?php
                        $percentage = ($row['c_total'] / $totalSum) * 100;
                        ?>
                        <span class="input-group-text" id="basic-addon3" style="width: 25%; display: flex; justify-content: flex-end;">
                            <?php echo number_format($percentage, 2); ?>%
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
}
