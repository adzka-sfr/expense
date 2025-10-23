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
    $month = $_POST['month'];
    $month = date('Y-m', strtotime($month));
    $username = $user['username'];

    // check for budget by month
    $stmt = $connect->prepare("SELECT * FROM t_budget WHERE c_month = :monthe AND c_username = :username");
    $stmt->bindParam(':monthe', $month);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Process the budget data as needed

        // Display the budget data along with actual outcome
        $stmt = $connect->prepare("SELECT b.id, a.c_name AS c_category, b.c_budget, 
            (SELECT SUM(c.c_nominal) FROM t_outcome c WHERE c.c_category = a.id AND DATE_FORMAT(c.c_datetime, '%Y-%m') = :monthe) AS c_actual
            FROM t_category a 
            JOIN t_budget b ON a.id = b.c_category 
            WHERE b.c_month = :monthe AND b.c_username = :username
        ");
        $stmt->bindParam(':monthe', $month);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
        <div class="row">
            <div class="col-12">
                <table class="table" style="font-size: 0.7em; width: 100%; text-align: center;">
                    <tr>
                        <td style="width: 33%;"><i class="fa-solid fa-hand-holding-dollar"></i> : Anggaran</td>
                        <td style="width: 33%;"><i class="fa-solid fa-money-bill-wave"></i> : Aktual</td>
                        <td style="width: 33%;"><i class="fa-solid fa-money-check-dollar"></i> : Sisa</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table" style="font-size: 0.8em;">
                    <thead class="text-center">
                        <tr>
                            <th class="align-top">Kategori</th>
                            <th class="align-top" style="text-align: right;">Anggaran/Aktual</th>
                            <th>
                                <button class="btn btn-primary btn-sm" onclick="tambahAnggaran('<?= $month ?>')">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) {
                        ?>
                            <tr>
                                <td rowspan="2" class="align-middle"><?= htmlspecialchars($row['c_category']) ?></td>
                                <td style="text-align: right;">
                                    <?= number_format($row['c_budget'], 0, '.', ',') ?> : <i class="fa-solid fa-hand-holding-dollar"></i>
                                    <br>
                                    <?= number_format($row['c_actual'], 0, '.', ',') ?> : <i class="fa-solid fa-money-bill-wave"></i>
                                </td>
                                <td rowspan="2" style="text-align: center; font-size:2em" class="align-middle">
                                    <button class="btn btn-sm btn-warning" onclick="editBudget('<?= $row['id'] ?>','<?= $row['c_category'] ?>','<?= $row['c_budget'] ?>')"><i class="fa-solid fa-wrench"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;">
                                    <b><?= number_format($row['c_budget'] - $row['c_actual'], 0, '.', ',') ?> : <i class="fa-solid fa-money-check-dollar"></i></b>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    } else {
    ?>
        <div class="row">
            <div class="col-12 mt-3 text-center">
                <button class="btn btn-primary btn-sm" onclick="tambahAnggaran('<?= $month ?>')">
                    <i class="fa-solid fa-plus"></i> Buat anggaran
                </button>
            </div>
        </div>

<?php
    }
}
