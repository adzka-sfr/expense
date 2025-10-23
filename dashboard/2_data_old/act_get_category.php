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

    // check is there any data in database
    $stmt = $connect->prepare("SELECT * FROM t_category WHERE c_username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($result)) {
        $result = null;
    }

?>
    <table class="table" style="font-size: 0.8em;">
        <thead class="text-center">
            <tr>
                <th scope="col" style="text-align: left;">Nama</th>
                <th scope="col">Jenis</th>
                <th scope="col" style="width: 5%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                foreach ($result as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['c_name']; ?></td>
                        <td class="text-center <?php echo $row['c_type'] == 'pengeluaran' ? 'text-danger' : 'text-success'; ?>"><?php echo ucwords($row['c_type']); ?></td>
                        <td class="text-center">
                            <button type="button" onclick="editCategory('<?= $row['id'] ?>','<?= $row['c_name'] ?>','<?= $row['c_type'] ?>','<?= $row['c_status'] ?>','<?= $row['c_icon'] ?>')" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>