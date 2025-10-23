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
    $id = $_POST['id'];
    $statuse = $_POST['statuse'];
    $username = $user['username'];
    $status_data = 'active';

    if ($statuse === 'pengeluaran') {
        $query = "SELECT t_outcome.*, t_payment.c_name AS payment_method, t_category.c_name AS category_name 
                  FROM t_outcome 
                  JOIN t_payment ON t_outcome.c_payment = t_payment.id 
                  JOIN t_category ON t_outcome.c_category = t_category.id 
                  WHERE t_outcome.id = :id";
    } else {
        $query = "SELECT t_income.*, t_payment.c_name AS payment_method, t_category.c_name AS category_name 
                  FROM t_income 
                  JOIN t_payment ON t_income.c_payment = t_payment.id 
                  JOIN t_category ON t_income.c_category = t_category.id 
                  WHERE t_income.id = :id";
    }

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get list of categories
    $categoryQuery = "SELECT id, c_name FROM t_category WHERE c_username = :username AND c_type = :statuse AND c_status = :status_data";
    $categoryStmt = $connect->prepare($categoryQuery);
    $categoryStmt->bindParam(':username', $username, PDO::PARAM_STR);
    $categoryStmt->bindParam(':statuse', $statuse, PDO::PARAM_STR);
    $categoryStmt->bindParam(':status_data', $status_data, PDO::PARAM_STR);
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get list of payment methods
    $paymentQuery = "SELECT id, c_name FROM t_payment WHERE c_username = :username AND c_status = :status_data";
    $paymentStmt = $connect->prepare($paymentQuery);
    $paymentStmt->bindParam(':username', $username, PDO::PARAM_STR);
    $paymentStmt->bindParam(':status_data', $status_data, PDO::PARAM_STR);
    $paymentStmt->execute();
    $paymentMethods = $paymentStmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <script>
        // Populate category dropdown
        var categories = <?= json_encode($categories) ?>;
        var categorySelect = document.getElementById('category-transaction');
        categories.forEach(category => {
            var option = document.createElement('option');
            option.value = category.id;
            option.text = category.c_name;
            if (category.id == <?= $data['c_category'] ?>) {
                option.selected = true;
            }
            categorySelect.appendChild(option);
        });

        // Populate payment method dropdown
        var paymentMethods = <?= json_encode($paymentMethods) ?>;
        var paymentSelect = document.getElementById('method-transaction');
        paymentMethods.forEach(method => {
            var option = document.createElement('option');
            option.value = method.id;
            option.text = method.c_name;
            if (method.id == <?= $data['c_payment'] ?>) {
                option.selected = true;
            }
            paymentSelect.appendChild(option);
        });
    </script>

    <input type="hidden" name="id-transaction" id="id-transaction" value="<?= $id ?>">
    <input type="hidden" name="statuse-transaction" id="statuse-transaction" value="<?= $statuse ?>">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="form-group input-group-sm">
                <label for="exampleInputEmail1">Kategori</label>
                <select class="search-biasa-transaction" style="width: 100%;" name="category-transaction" id="category-transaction">
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <div class="form-group input-group-sm">
                <label for="exampleInputEmail1">Metode</label>
                <select class="search-biasa-transaction" style="width: 100%;" name="method-transaction" id="method-transaction">
                </select>
            </div>
        </div>
        <div class="col-6 mb-3">
            <div class="form-group input-group-sm">
                <label for="exampleInputEmail1">Saldo</label>
                <input class="form-control" disabled type="text" name="saldo-transaction" id="saldo-transaction" style="text-align: right;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="basic-url" class="form-label">Nominal</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">Rp</span>
                    <input type="number" class="form-control" oninput="validateInputJustNumber(event)" id="nominal-transaction" aria-describedby="basic-addon3 basic-addon4" value="<?= $data['c_nominal'] ?>">
                </div>
                <span id="error-nominal-transaction" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nominal</span>
                <span id="error-nominal-transaction2" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal harus lebih dari 0</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Detail</label>
                <textarea name="detail" id="detail-transaction" class="form-control"><?= $data['c_detail'] ?></textarea>
                <span id="error-detail-transaction" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Detail wajib diisi</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Waktu</label>
                <input class="form-control" type="datetime-local" name="time-transaction" id="time-transaction" value="<?= date('Y-m-d H:i:s', strtotime($data['c_datetime'])) ?>">
                <span id="error-time-transaction" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan waktu start</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteTransaction('<?= $id ?>', '<?= $statuse ?>')">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>

    <script>
        getSaldoTransaction();

        function getSaldoTransaction() {
            var methode = $('#method-transaction').val();
            $.ajax({
                url: '1_data/get_saldo.php',
                type: 'POST',
                data: {
                    methode: methode
                },
                success: function(response) {
                    if (!isNaN(response)) {
                        response = parseInt(response);
                        if (response > 0) {
                            $('#saldo-transaction').addClass('text-success').removeClass('text-danger');
                        } else if (response < 0) {
                            $('#saldo-transaction').addClass('text-danger').removeClass('text-success');
                        } else {
                            $('#saldo-transaction').removeClass('text-success text-danger');
                        }
                        response = response.toLocaleString('en-US');
                    }
                    $('#saldo-transaction').val(response);
                }
            });
        }

        // function when method transaction change
        $('#method-transaction').change(function() {
            getSaldoTransaction();
        });

        $('.search-biasa-transaction').select2({
            placeholder: "Pilih salah satu",
            allowClear: false,
            language: "id",
            dropdownParent: $('#category-transaction').parent()
        });
    </script>
<?php
}
