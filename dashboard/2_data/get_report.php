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

    $username = $user['username'];
    $month = $_POST['month'] ?? date('Y-m', strtotime($now));
    $month = date('Y-m', strtotime($month));

    $query_dates = "SELECT DISTINCT DATE_FORMAT(c_datetime, '%Y-%m-%d') as c_date 
                    FROM t_outcome 
                    WHERE c_username = :username AND DATE_FORMAT(c_datetime, '%Y-%m') = :monthe
                    ORDER BY c_date DESC";
    $stmt_dates = $connect->prepare($query_dates);
    $stmt_dates->bindParam(':username', $username);
    $stmt_dates->bindParam(':monthe', $month);
    $stmt_dates->execute();
    $distinct_dates = $stmt_dates->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT a.id, a.c_datetime , DATE_FORMAT(a.c_datetime, '%Y-%m-%d') as c_date,  b.c_icon, b.c_name as c_category, a.c_detail , a.c_nominal 
              FROM t_outcome a
              INNER JOIN t_category b
              ON a.c_category = b.id 
              WHERE a.c_username = :username AND DATE_FORMAT(a.c_datetime, '%Y-%m') = :monthe ORDER BY a.c_datetime DESC";
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

    // when data is empty
    if (empty($grouped_transactions)) {

        exit;
    }
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
                            foreach ($transactions as $transaction) {
                                $total += $transaction['c_nominal'];
                            }
                            echo number_format($total, 0, '.', ',');
                            ?>
                        </th>
                    </tr>

                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <th class="align-middle" style="font-size: 2em; padding-left: 0px; padding-right: 10px; width: 5%; text-align: center">
                                <i class="<?= $transaction['c_icon'] ?>"></i>
                            </th>
                            <td class="align-top" style="padding-left: 10px; padding-right: 0px;">
                                <div class="row">
                                    <div class="col-12" style="font-size: 0.8em;">
                                        <?= $transaction['c_category'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" style="font-size: 0.8em; color: darkgrey;">
                                        <?= $transaction['c_detail'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" style="font-size: 0.5em; color: darkgrey;">
                                        <i class="fa-solid fa-trash text-danger" onclick="deleteTransaction('<?= $transaction['id'] ?>','<?= $transaction['c_category'] ?>', '<?= $transaction['c_detail'] ?>', '<?= date('Y-m-d H:i', strtotime($transaction['c_datetime'])) ?>')"></i> <?= date('H:i', strtotime($transaction['c_datetime'])) ?>
                                    </div>
                                </div>
                            </td>
                            <th class="align-top text-danger" style="text-align: right; padding-left: 0px; padding-right: 0px; font-size: 0.8em;">
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
