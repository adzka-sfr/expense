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
    $kata_kunci = $_POST['kata_kunci'];

    $username = $user['username'];

    $stmt = $connect->prepare("SELECT c_date, c_datetime, c_detail, c_nominal, c_category_name, c_status FROM v_transaction WHERE c_username = :username AND c_detail LIKE '%$kata_kunci%' OR c_username = :username AND c_category_name LIKE '%$kata_kunci%' ORDER BY c_datetime DESC");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
    <table class="table table-bordered" style="font-size: 0.5em;">
        <thead style="text-align: center;">
            <tr>
                <th style="width: 20%;">Tanggal</th>
                <th style="width: 25%;">Nominal</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($result)) {
            ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data</td>
                </tr>
                <?php
            } else {
                foreach ($result as $data) {
                ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $data['c_date']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($data['c_nominal'], 0, ',', ','); ?></td>
                        <td>
                            Kategori: <?php echo $data['c_category_name']; ?><br>
                            Status: <span class="<?php echo $data['c_status'] === 'pengeluaran' ? 'text-danger' : 'text-success'; ?>">
                                <?php echo $data['c_status']; ?>
                            </span><br>
                            Detail: <?php echo $data['c_detail']; ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
<?php
}
