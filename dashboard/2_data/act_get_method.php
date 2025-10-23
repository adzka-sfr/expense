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

    // check is there any data in database
    $stmt = $connect->prepare("SELECT * FROM t_payment WHERE c_username = :username");
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
                        <td class="text-center">
                            <button type="button" onclick="editMethod('<?= $row['id'] ?>','<?= $row['c_name'] ?>','<?= $row['c_status'] ?>')" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="2" class="text-center">Tidak ada data</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>