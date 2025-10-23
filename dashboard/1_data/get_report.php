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

    $username = $user['username'];
    $month = date('Y-m', strtotime($now));

    $query_dates = "SELECT DISTINCT DATE_FORMAT(c_date, '%Y-%m-%d') as c_date 
                    FROM v_transaction 
                    WHERE c_username = :username AND DATE_FORMAT(c_date, '%Y-%m') = :monthe
                    ORDER BY c_date DESC";
    $stmt_dates = $connect->prepare($query_dates);
    $stmt_dates->bindParam(':username', $username);
    $stmt_dates->bindParam(':monthe', $month);
    $stmt_dates->execute();
    $distinct_dates = $stmt_dates->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT id, c_datetime, c_date, c_detail, c_nominal, c_category_name, c_payment_name, c_category_icon, c_status 
              FROM v_transaction 
              WHERE c_username = :username AND DATE_FORMAT(c_date, '%Y-%m') = :monthe
              ORDER BY c_datetime DESC";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':monthe', $month);
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $grouped_transactions = [];
    foreach ($distinct_dates as $date) {
        $grouped_transactions[$date['c_date']] = [];
    }

    foreach ($transactions as $transaction) {
        $date = $transaction['c_date'];
        $grouped_transactions[$date][] = $transaction;
    }

    if (empty($distinct_dates)) {
?>
        <span style="color: darkgrey; text-align: center;">
            Tidak ada transaksi
        </span>
    <?php
    } else {
    ?>
        <?php foreach ($grouped_transactions as $date => $transactions): ?>
            <div class="card mt-2" style="padding-left: 0px; padding-right: 0px; text-align: left;">
                <div class="card-body">
                    <table style="width: 100%;" class="table">
                        <tr>
                            <th class="align-middle" style="font-size: 2em; padding-left: 0px; padding-right: 10px; width: 5%; text-align: center; color: <?= $user['theme'] ?>">
                                <?= date('d', strtotime($date)) ?>
                            </th>
                            <td class="align-middle" style="padding-left: 10px; padding-right: 0px;">
                                <div class="row">
                                    <div class="col-12" style="font-size: 0.8em; color: darkgrey;">
                                        <?= $hari[date('l', strtotime($date))]  ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" style="font-size: 0.8em; color: darkgrey;">
                                        <?= $bulan[date('F', strtotime($date))] . ' ' . date('Y', strtotime($date)) ?>
                                    </div>
                                </div>
                            </td>
                            <th class="align-top" style="text-align: right; padding-left: 0px; padding-right: 0px;">
                                <?php
                                $total = 0;
                                $total_pemasukan = 0;
                                $total_pengeluaran = 0;
                                foreach ($transactions as $transaction) {
                                    if ($transaction['c_status'] === 'pemasukan') {
                                        $total_pemasukan += $transaction['c_nominal'];
                                    } else {
                                        $total_pengeluaran += $transaction['c_nominal'];
                                    }
                                }
                                $total = $total_pemasukan - $total_pengeluaran;
                                echo number_format($total, 0, '.', ',');
                                ?>
                            </th>
                        </tr>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr onclick="openDetailTransaction('<?= $transaction['id'] ?>', '<?= $transaction['c_status'] ?>', '<?= $date ?>')" style="cursor:pointer;">
                                <th class="align-middle" style="font-size: 2em; padding-left: 0px; padding-right: 10px; width: 5%; text-align: center">
                                    <i class="<?= $transaction['c_category_icon'] ?>"></i>
                                </th>
                                <td class="align-top" style="padding-left: 10px; padding-right: 0px;">
                                    <div class="row">
                                        <div class="col-12" style="font-size: 0.8em;">
                                            <?= $transaction['c_category_name'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" style="font-size: 0.8em; color: darkgrey;">
                                            <?= strlen($transaction['c_detail']) > 20 ? substr($transaction['c_detail'], 0, 25) . '...' : $transaction['c_detail'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" style="font-size: 0.5em; color: darkgrey;">
                                            <?= date('H:i', strtotime($transaction['c_datetime'])) ?> - <?= $transaction['c_payment_name'] ?>
                                        </div>
                                    </div>
                                </td>
                                <th class="align-top <?= $transaction['c_status'] === 'pemasukan' ? 'text-success' : 'text-danger' ?>" style="text-align: right; padding-left: 0px; padding-right: 0px; font-size: 0.8em;">
                                    <?= number_format($transaction['c_nominal'], 0, '.', ',') ?>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
<?php
    }
}
