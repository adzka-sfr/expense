<div class="card mb-4" style="padding-left: 0px; padding-right: 0px;">
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-12 text-center" style="color:darkgrey; font-size: 1em;">
                Kekayaan
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-0 mb-3 text-center">
                <button id="lihat-nominal" class="btn btn-sm btn-primary" style="font-size: 0.5em;"><i class="fa-solid fa-eye"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-0">
                <h3 id='kekayaan-hide' class="mb-0" style="display: none;"><sup>Rp</sup></h3>
                <h3 id='kekayaan' class="mb-0" style="display: none;"><sup>Rp</sup></h3>
                <h3 id="kekayaan-loading"><i class="fa-solid fa-circle-notch fa-spin"></i></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-0 mb-3 text-center">
                <button id="lihat-saldo" class="btn btn-sm btn-primary" style="font-size: 0.5em;">Lihat saldo</button>
            </div>
        </div>
        <div class="row">
            <div class="col-6 text-center" style="color:darkgrey; font-size: 1em; cursor:pointer;" id="last-month-nav">
                Bulan lalu
            </div>
            <div class="col-6 text-center font-weight-bold" id="this-month-nav" style="color:black; font-size: 1em; cursor:pointer;">
                Bulan ini
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <input type="month" name="select-last-month" onchange="getKekayaanLastMonth(),getDataReportByMonth(),loadReportLastMonth()" id="select-last-month" class="form-control mb-3" style="width: 50%; display: none;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="margin: 0; padding: 0;">
                        <td style="margin: 0; padding: 0;">Saldo awal</td>
                        <td style="text-align: right; margin: 0; padding: 0; display:none;" id="last-month-balance"></td>
                        <td style="text-align: right; margin: 0; padding: 0; display:none;" id="last-month-balance-hide"></td>
                        <td style="text-align: right; margin: 0; padding: 0;" id="last-month-balance-loading"><sup>Rp</sup> <i class="fa-solid fa-circle-notch fa-spin"></i></td>
                    </tr>
                    <tr style="margin: 0; padding: 0;">
                        <td style="margin: 0; padding: 0;">Saldo akhir</td>
                        <td style="text-align: right; margin: 0; padding: 0; display:none;" id="this-month-balance"></td>
                        <td style="text-align: right; margin: 0; padding: 0; display:none;" id="this-month-balance-hide"></td>
                        <td style="text-align: right; margin: 0; padding: 0;" id="this-month-balance-loading"><sup>Rp</sup> <i class="fa-solid fa-circle-notch fa-spin"></i></td>
                    </tr>
                    <tr style="margin: 0; padding: 0;">
                        <td style="margin: 0; padding: 0;"></td>
                        <td style="width: 30%; margin: 0; padding: 0;">
                            <hr style="margin: 0; padding: 0;">
                        </td>
                    </tr>
                    <tr style="margin: 0; padding: 0;">
                        <td style="margin: 0; padding: 0;"></td>
                        <th style="text-align: right; margin: 0; padding: 0; display:none;" id="difference-balance"></th>
                        <td style="text-align: right; margin: 0; padding: 0;" id="difference-balance-loading"><sup>Rp</sup> <i class="fa-solid fa-circle-notch fa-spin"></i></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div style="text-align: center;">
    <button id="input-page" disabled class="btn btn-sm btn-secondary" style="font-size: 0.6em; width: 20%;">Input</button>
    <button id="laporan-page" class="btn btn-sm btn-primary" style="font-size: 0.6em; width: 20%;">Laporan</button>
    <button id="cari-data-page" class="btn btn-sm btn-primary" style="font-size: 0.6em; width: 20%;">Cari data</button>
</div>

<div id="data-laporan" class="card mb-5 mt-2" style="padding-left: 0px; padding-right: 0px; display: none; margin-bottom: 50px;">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <button id="laporan-balance" disabled class="btn btn-sm btn-secondary" style="font-size: 0.6em; width: 20%;">Balance</button>
                <button id="laporan-bar" disabled class="btn btn-sm btn-primary" style="font-size: 0.6em; width: 20%;">Jumlah</button>
                <button id="laporan-pie" class="btn btn-sm btn-primary" style="font-size: 0.6em; width: 20%;">Persentase</button>
                <button id="laporan-anggaran" class="btn btn-sm btn-primary" style="font-size: 0.6em; width: 20%;">Anggaran</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="data-laporan-chart" style="display: none;">

            </div>
            <div class="col-12" id="data-laporan-chart-loading" style="text-align: center; margin-top: 50px;">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<div id="data-input" style="display: none; margin-bottom: 50px;">
    <div class="card mt-2" style="padding-left: 0px; padding-right: 0px;">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link nav-input active" data-toggle="tab" href="#pengeluaran">Pengeluaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-input" data-toggle="tab" href="#pemasukan">Pemasukan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-input" data-toggle="tab" href="#topup">Top Up</a>
                </li>
            </ul>
        </div>
        <div class="card-body" id="pengeluaran">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select class="search-biasa" style="width: 100%;height:100px" onchange="getBudget()" name="category-out" id="category-out">
                        </select>
                        <span id="error-category-out" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memilih kategory</span>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-group input-group-sm">
                        <label for="exampleInputEmail1">Sisa anggaran</label>
                        <input class="form-control" disabled type="text" name="budget" id="budget" style="text-align: right;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Metode</label>
                        <select class="search-biasa" style="width: 100%;" onchange="getSaldo()" name="method-out" id="method-out">
                        </select>
                        <span id="error-method-out" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memilih metode</span>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-group input-group-sm">
                        <label for="exampleInputEmail1">Saldo</label>
                        <input class="form-control" disabled type="text" name="saldo" id="saldo" style="text-align: right;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Rp</span>
                            <input type="number" class="form-control" oninput="validateInputJustNumber(event)" id="nominal-out" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                        <span id="error-nominal-out" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nominal</span>
                        <span id="error-nominal-out2" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal harus lebih dari 0</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Detail</label>
                        <textarea name="detail" id="detail-out" class="form-control"></textarea>
                        <span id="error-detail-out" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Detail wajib diisi</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Waktu</label>
                        <input class="form-control" type="datetime-local" onchange="getBudget()" name="time-out" id="time-out">
                        <span id="error-time-out" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan waktu</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <button class="btn btn-secondary btn-sm btn-cancel" style="width: 80%;">Cancel</button>
                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-primary btn-sm" style="width: 80%;" id="save-out">Save</button>
                </div>
            </div>
        </div>
        <div class="card-body" id="pemasukan" style="display: none;">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select class="search-biasa" style="width: 100%;" name="category-in" id="category-in">
                        </select>
                        <span id="error-category-in" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memilih kategori</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Metode</label>
                        <select class="search-biasa" style="width: 100%;" name="method-in" id="method-in">
                        </select>
                        <span id="error-method-in" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memilih metode</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Rp</span>
                            <input type="number" class="form-control" oninput="validateInputJustNumber(event)" id="nominal-in" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                        <span id="error-nominal-in" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nominal</span>
                        <span id="error-nominal-in2" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal harus lebih dari 0</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Detail</label>
                        <textarea name="detail" id="detail-in" class="form-control"></textarea>
                        <span id="error-detail-in" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan detail</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Waktu</label>
                        <input class="form-control" type="datetime-local" name="time-in" id="time-in">
                        <span id="error-time-in" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan waktu</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <button class="btn btn-secondary btn-sm btn-cancel" style="width: 80%;">Cancel</button>
                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-primary btn-sm" style="width: 80%;" id="save-in">Save</button>
                </div>
            </div>
        </div>
        <div class="card-body" id="topup" style="display: none;">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dari</label>
                        <select class="search-biasa" style="width: 100%;" name="topup-from" id="topup-from" onchange="getMethodWithException(this.value),getSaldoTopup(this.value,'from')">
                        </select>
                        <span id="error-topup-from" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Dari mana</span>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-group input-group-sm">
                        <label for="exampleInputEmail1">Saldo</label>
                        <input class="form-control" disabled type="text" name="saldo-from" id="saldo-from">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ke</label>
                        <select disabled class="search-biasa" style="width: 100%;" name="topup-to" id="topup-to" onchange="getSaldoTopup(this.value,'to')">
                        </select>
                        <span id="error-topup-to" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Ke mana</span>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-group input-group-sm">
                        <label for="exampleInputEmail1">Saldo</label>
                        <input class="form-control" disabled type="text" name="saldo-to" id="saldo-to">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Rp</span>
                            <input type="number" class="form-control" oninput="validateInputJustNumber(event)" id="nominal-topup" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                        <span id="error-nominal-topup" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal wajib diisi</span>
                        <span id="error-nominal-topup2" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal wajib diisi</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Waktu</label>
                        <input class="form-control" type="datetime-local" name="time-topup" id="time-topup">
                        <span id="error-time-topup" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan waktu start</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <button class="btn btn-secondary btn-sm btn-cancel" style="width: 80%;">Cancel</button>
                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-primary btn-sm" style="width: 80%;" id="save-topup">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="data-report" style="text-align: center; display:none; margin-bottom: 50px;">
</div>
<div id="data-report-loading" style="text-align: center; margin-top: 50px;">
    <i class="fa-solid fa-circle-notch fa-spin"></i>
</div>

<div id="data-cari" style="display: none; margin-bottom: 50px;">
    <div class="card mt-2" style="padding-left: 0px; padding-right: 0px;">
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kata kunci detail</label>
                        <input type="text" name="kata-kunci" id="kata-kunci" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3" id="data-cari-table" style="display: none;">

                </div>
                <div class="col-12" id="data-cari-table-loading" style="text-align: center; margin-top: 50px; display:none;">
                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal lihat saldo -->
<div class="modal fade" id="modal-lihat-saldo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Saldo Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="data-value-saldo" style="display: none;">

            </div>
            <div class="modal-body" id="data-value-saldo-loading">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal lihat transaksi -->
<div class="modal fade" id="modal-lihat-transaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Transaksi <b id="date-transaksi"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="data-value-transaksi" style="display: none;">

            </div>
            <div class="modal-body" id="data-value-transaksi-loading">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary btn-sm" id="update-transaction">Save</button>
            </div>
        </div>
    </div>
</div>

<hr>

<button class="btn btn-primary btn-floating" id="add-data" style="position: fixed; bottom: 80px; right: 20px;">
    <i class="fa fa-plus"></i>
</button>

<script>
    $(document).ready(function() {
        getKekayaan();
        getDataReport();

        $('#add-data').click(function() {
            $('#data-input').toggle();
            $('#data-report').toggle();
            $('#add-data').toggle();
            getCategory('pengeluaran');
            getCategory('pemasukan');
            getMethod();
            getDateTime();
        });

        $('.btn-cancel').click(function() {
            $('#data-input').toggle();
            $('#data-report').toggle();
            $('#add-data').toggle();

            // clear all field
            $('#budget').val('');
            $('#saldo').val('');
            $('#nominal-out').val('');
            $('#detail-out').val('');
            $('#time-out').val('');
            $('#nominal-in').val('');
            $('#detail-in').val('');
            $('#time-in').val('');
            $('#nominal-topup').val('');
            $('#time-topup').val('');
            $('#saldo-from').val('');
            $('#saldo-to').val('');
            $('#topup-to').html('<option value="">Pilih metode</option>');
            $('#topup-to').prop('disabled', true);
        });

        $('.nav-link.nav-input').click(function() {
            $('.nav-link.nav-input').removeClass('active');
            $(this).addClass('active');
            var target = $(this).attr('href').substring(1);
            $('#data-input .card-body').hide();
            $('#' + target).show();
            getDateTime();
        });
    });

    // function to get kekayaan
    function getKekayaan() {
        $('#kekayaan-loading').show();
        $('#kekayaan').hide();
        $('#kekayaan-hide').hide();
        $('#last-month-balance-loading').show();
        $('#last-month-balance').hide();
        $('#last-month-balance-hide').hide();
        $('#this-month-balance-loading').show();
        $('#this-month-balance').hide();
        $('#this-month-balance-hide').hide();
        $('#difference-balance-loading').show();
        $('#difference-balance').hide();
        $.ajax({
            url: '1_data/get_kekayaan.php',
            type: 'POST',
            success: function(response) {
                $('#kekayaan-loading').hide();
                $('#kekayaan-hide').show();
                $('#last-month-balance-loading').hide();
                $('#last-month-balance-hide').show();
                $('#this-month-balance-loading').hide();
                $('#this-month-balance-hide').show();
                $('#difference-balance-loading').hide();
                $('#difference-balance').show();
                var response = JSON.parse(response);
                var formattedKekayaan = parseInt(response.kekayaan).toLocaleString('en-US');
                var formattedKekayaanHide = '*'.repeat(formattedKekayaan.length);
                var formattedlastmonth = '*'.repeat(parseInt(response.last_month_balance).toLocaleString('en-US').length);
                var formattedthismonth = '*'.repeat(parseInt(response.this_month_balance).toLocaleString('en-US').length);
                $('#kekayaan-hide').html('<sup>Rp</sup> ' + formattedKekayaanHide);
                $('#last-month-balance-hide').html('<sup>Rp</sup> ' + formattedlastmonth);
                $('#this-month-balance-hide').html('<sup>Rp</sup> ' + formattedthismonth);
                $('#kekayaan').html('<sup>Rp</sup> ' + formattedKekayaan);
                $('#last-month-balance').html('<sup>Rp</sup> ' + parseInt(response.last_month_balance).toLocaleString('en-US'));
                $('#this-month-balance').html('<sup>Rp</sup> ' + parseInt(response.this_month_balance).toLocaleString('en-US'));
                var difference = parseInt(response.this_month_balance) - parseInt(response.last_month_balance);
                if (difference > 0) {
                    $('#difference-balance').html('<sup>Rp</sup> ' + difference.toLocaleString('en-US')).addClass('text-success').removeClass('text-danger');
                } else if (difference < 0) {
                    $('#difference-balance').html('<sup>Rp</sup> ' + difference.toLocaleString('en-US')).addClass('text-danger').removeClass('text-success');
                } else {
                    $('#difference-balance').html('<sup>Rp</sup> ' + difference.toLocaleString('en-US')).removeClass('text-success text-danger');
                }
            }
        });
    }

    // function to show and hide kekayaan
    $('#lihat-nominal').click(function() {
        $('#kekayaan').toggle();
        $('#kekayaan-hide').toggle();
        $('#last-month-balance').toggle();
        $('#last-month-balance-hide').toggle();
        $('#this-month-balance').toggle();
        $('#this-month-balance-hide').toggle();
    });

    // functioni to get kekayaan by month
    function getKekayaanLastMonth() {
        var month = $('#select-last-month').val();
        $('#last-month-balance-loading').show();
        $('#last-month-balance').hide();
        $('#last-month-balance-hide').hide();
        $('#this-month-balance-loading').show();
        $('#this-month-balance').hide();
        $('#this-month-balance-hide').hide();
        $('#difference-balance-loading').show();
        $('#difference-balance').hide();
        $.ajax({
            url: '1_data/get_kekayaan_last_month.php',
            type: 'POST',
            data: {
                month: month
            },
            success: function(response) {
                $('#last-month-balance-loading').hide();
                $('#last-month-balance').show();
                $('#this-month-balance-loading').hide();
                $('#this-month-balance').show();
                $('#difference-balance-loading').hide();
                $('#difference-balance').show();

                var response = JSON.parse(response);
                $('#last-month-balance').html('<sup>Rp</sup> ' + parseInt(response.last_month_balance).toLocaleString('en-US'));
                $('#this-month-balance').html('<sup>Rp</sup> ' + parseInt(response.this_month_balance).toLocaleString('en-US'));
                var difference = parseInt(response.this_month_balance) - parseInt(response.last_month_balance);
                if (difference > 0) {
                    $('#difference-balance').html('<sup>Rp</sup> ' + difference.toLocaleString('en-US')).addClass('text-success').removeClass('text-danger');
                } else if (difference < 0) {
                    $('#difference-balance').html('<sup>Rp</sup> ' + difference.toLocaleString('en-US')).addClass('text-danger').removeClass('text-success');
                } else {
                    $('#difference-balance').html('<sup>Rp</sup> ' + difference.toLocaleString('en-US')).removeClass('text-success text-danger');
                }
            }
        });
    }

    // function to get data report
    function getDataReport() {
        $('#data-report-loading').show();
        $('#data-report').hide();
        $.ajax({
            url: '1_data/get_report.php',
            type: 'POST',
            success: function(response) {
                $('#data-report-loading').hide();
                $('#data-report').show();
                $('#data-report').html(response);
            }
        });
    }

    // function to get data report by month
    function getDataReportByMonth() {
        var month = $('#select-last-month').val();
        $('#data-report-loading').show();
        $('#data-report').hide();
        $.ajax({
            url: '1_data/get_report_last_month.php',
            type: 'POST',
            data: {
                month: month
            },
            success: function(response) {
                $('#data-report-loading').hide();
                $('#data-report').show();
                $('#data-report').html(response);
            }
        });
    }

    // function to get list of category
    function getCategory(type) {
        $.ajax({
            url: '1_data/get_category.php',
            type: 'POST',
            data: {
                type: type
            },
            success: function(response) {
                if (type == 'pengeluaran') {
                    $('#category-out').html(response);
                } else {
                    $('#category-in').html(response);
                };
            }
        });
    }

    // function to get list of method
    function getMethod() {
        $.ajax({
            url: '1_data/get_method.php',
            type: 'POST',
            success: function(response) {
                $('#method-out').html(response);
                $('#method-in').html(response);
                $('#topup-from').html(response);
            }
        });
    }

    // function to get list of method with exception
    function getMethodWithException(exception) {
        $('#saldo-to').val('');
        $('#topup-to').prop('disabled', true);
        $.ajax({
            url: '1_data/get_method.php',
            type: 'POST',
            data: {
                exception: exception
            },
            success: function(response) {
                $('#topup-to').prop('disabled', false);
                $('#topup-to').html(response);
            }
        });
    }

    // function to get actual date and time
    function getDateTime() {
        var date = new Date();
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        var hour = String(date.getHours()).padStart(2, '0');
        var minute = String(date.getMinutes()).padStart(2, '0');
        var second = String(date.getSeconds()).padStart(2, '0');
        var dateTime = year + '-' + month + '-' + day + 'T' + hour + ':' + minute + ':' + second;

        $('#time-out').val(dateTime);
        $('#time-in').val(dateTime);
        $('#time-topup').val(dateTime);
    }

    // function to get budget
    function getBudget() {
        var category = $('#category-out').val();
        var time = $('#time-out').val();
        $.ajax({
            url: '1_data/get_budget.php',
            type: 'POST',
            data: {
                category: category,
                time: time
            },
            success: function(response) {
                if (!isNaN(response)) {
                    response = parseInt(response);
                    if (response > 0) {
                        $('#budget').addClass('text-success').removeClass('text-danger');
                    } else if (response < 0) {
                        $('#budget').addClass('text-danger').removeClass('text-success');
                    } else {
                        $('#budget').removeClass('text-success text-danger');
                    }
                    response = response.toLocaleString('en-US');
                }
                $('#budget').val(response);
            }
        });
    }

    // function to get saldo
    function getSaldo() {
        var methode = $('#method-out').val();
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
                        $('#saldo').addClass('text-success').removeClass('text-danger');
                    } else if (response < 0) {
                        $('#saldo').addClass('text-danger').removeClass('text-success');
                    } else {
                        $('#saldo').removeClass('text-success text-danger');
                    }
                    response = response.toLocaleString('en-US');
                }
                $('#saldo').val(response);
            }
        });
    }

    // function to get saldo topup
    function getSaldoTopup(id, type) {
        var methode = $('#topup-' + type).val();
        $.ajax({
            url: '1_data/get_saldo.php',
            type: 'POST',
            data: {
                methode: id
            },
            success: function(response) {
                if (!isNaN(response)) {
                    response = parseInt(response);
                    if (response > 0) {
                        $('#saldo-' + type).addClass('text-success').removeClass('text-danger');
                    } else if (response < 0) {
                        $('#saldo-' + type).addClass('text-danger').removeClass('text-success');
                    } else {
                        $('#saldo-' + type).removeClass('text-success text-danger');
                    }
                    response = response.toLocaleString('en-US');
                }
                $('#saldo-' + type).val(response);
            }
        });
    }

    // function to save outcome
    $('#save-out').click(function() {
        var category = $('#category-out').val();
        var methode = $('#method-out').val();
        var nominal = $('#nominal-out').val();
        var detail = $('#detail-out').val();
        var time = $('#time-out').val();
        if (!category) {
            $('#error-category-out').show();
            return;
        } else {
            $('#error-category-out').hide();
        }

        if (!methode) {
            $('#error-method-out').show();
            return;
        } else {
            $('#error-method-out').hide();
        }

        if (!nominal) {
            $('#error-nominal-out').show();
            return;
        } else {
            $('#error-nominal-out').hide();
        }

        if (nominal <= 0) {
            $('#error-nominal-out2').show();
            return;
        } else {
            $('#error-nominal-out2').hide();
        }

        if (!detail) {
            $('#error-detail-out').show();
            return;
        } else {
            $('#error-detail-out').hide();
        }

        if (!detail.trim()) {
            $('#error-detail-out').show();
            return;
        } else {
            $('#error-detail-out').hide();
        }

        if (!time) {
            $('#error-time-out').show();
            return;
        } else {
            $('#error-time-out').hide();
        }

        var saldo = parseInt($('#saldo').val().replace(/,/g, ''));
        if (saldo - nominal < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: 'Saldo tidak mencukupi!',
            });
            return;
        }

        $('#category-out').prop('disabled', true);
        $('#method-out').prop('disabled', true);
        $('#nominal-out').prop('disabled', true);
        $('#detail-out').prop('disabled', true);
        $('#time-out').prop('disabled', true);
        $('#save-out').prop('disabled', true);

        $.ajax({
            url: '1_data/save_outcome.php',
            type: 'POST',
            data: {
                category: category,
                methode: methode,
                nominal: nominal,
                detail: detail,
                time: time
            },
            success: function(response) {
                $('#category-out').prop('disabled', false);
                $('#method-out').prop('disabled', false);
                $('#nominal-out').prop('disabled', false);
                $('#detail-out').prop('disabled', false);
                $('#time-out').prop('disabled', false);
                $('#save-out').prop('disabled', false);
                if (response == 'success') {
                    $('#budget').val('');
                    $('#saldo').val('');
                    $('#nominal-out').val('');
                    $('#detail-out').val('');
                    $('#time-out').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    });
                    $('#data-input').toggle();
                    $('#data-report').toggle();
                    $('#add-data').toggle();
                    getKekayaan();
                    getDataReport();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data gagal disimpan',
                    });
                }
            }
        });
    });

    // function to save income
    $('#save-in').click(function() {
        var category = $('#category-in').val();
        var methode = $('#method-in').val();
        var nominal = $('#nominal-in').val();
        var detail = $('#detail-in').val();
        var time = $('#time-in').val();
        if (!category) {
            $('#error-category-in').show();
            return;
        } else {
            $('#error-category-in').hide();
        }

        if (!methode) {
            $('#error-method-in').show();
            return;
        } else {
            $('#error-method-in').hide();
        }

        if (!nominal) {
            $('#error-nominal-in').show();
            return;
        } else {
            $('#error-nominal-in').hide();
        }

        if (nominal <= 0) {
            $('#error-nominal-in2').show();
            return;
        } else {
            $('#error-nominal-in2').hide();
        }

        if (!detail) {
            $('#error-detail-in').show();
            return;
        } else {
            $('#error-detail-in').hide();
        }

        if (!detail.trim()) {
            $('#error-detail-in').show();
            return;
        } else {
            $('#error-detail-in').hide();
        }

        if (!time) {
            $('#error-time-in').show();
            return;
        } else {
            $('#error-time-in').hide();
        }

        $('#category-in').prop('disabled', true);
        $('#method-in').prop('disabled', true);
        $('#nominal-in').prop('disabled', true);
        $('#detail-in').prop('disabled', true);
        $('#time-in').prop('disabled', true);
        $('#save-in').prop('disabled', true);

        $.ajax({
            url: '1_data/save_income.php',
            type: 'POST',
            data: {
                category: category,
                methode: methode,
                nominal: nominal,
                detail: detail,
                time: time
            },
            success: function(response) {
                $('#category-in').prop('disabled', false);
                $('#method-in').prop('disabled', false);
                $('#nominal-in').prop('disabled', false);
                $('#detail-in').prop('disabled', false);
                $('#time-in').prop('disabled', false);
                $('#save-in').prop('disabled', false);

                if (response == 'success') {
                    $('#nominal-in').val('');
                    $('#detail-in').val('');
                    $('#time-in').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    });
                    $('#data-input').toggle();
                    $('#data-report').toggle();
                    $('#add-data').toggle();
                    getKekayaan();
                    getDataReport();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data gagal disimpan',
                    });
                }
            }
        });
    });

    // function to save topup
    $('#save-topup').click(function() {
        var from = $('#topup-from').val();
        var to = $('#topup-to').val();
        var nominal = $('#nominal-topup').val();
        var time = $('#time-topup').val();
        if (!from) {
            $('#error-topup-from').show();
            return;
        } else {
            $('#error-topup-from').hide();
        }

        if (!to) {
            $('#error-topup-to').show();
            return;
        } else {
            $('#error-topup-to').hide();
        }

        if (!nominal) {
            $('#error-nominal-topup').show();
            return;
        } else {
            $('#error-nominal-topup').hide();
        }

        if (nominal <= 0) {
            $('#error-nominal-topup2').show();
            return;
        } else {
            $('#error-nominal-topup2').hide();
        }

        if (!time) {
            $('#error-time-topup').show();
            return;
        } else {
            $('#error-time-topup').hide();
        }

        var saldoFrom = parseInt($('#saldo-from').val().replace(/,/g, ''));
        if (saldoFrom - nominal < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: 'Saldo tidak mencukupi!',
            });
            return;
        }

        $('#topup-from').prop('disabled', true);
        $('#topup-to').prop('disabled', true);
        $('#nominal-topup').prop('disabled', true);
        $('#time-topup').prop('disabled', true);
        $('#save-topup').prop('disabled', true);

        $.ajax({
            url: '1_data/save_topup.php',
            type: 'POST',
            data: {
                from: from,
                to: to,
                nominal: nominal,
                time: time
            },
            success: function(response) {
                $('#topup-from').prop('disabled', false);
                $('#topup-to').prop('disabled', false);
                $('#nominal-topup').prop('disabled', false);
                $('#time-topup').prop('disabled', false);
                $('#save-topup').prop('disabled', false);

                if (response == 'success') {
                    $('#nominal-topup').val('');
                    $('#time-topup').val('');
                    $('#saldo-from').val('');
                    $('#saldo-to').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    });

                    $('#topup-to').html('<option value="">Pilih metode</option>');
                    $('#topup-to').prop('disabled', true);
                    $('#data-input').toggle();
                    $('#data-report').toggle();
                    $('#add-data').toggle();
                    getKekayaan();
                    getDataReport();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data gagal disimpan',
                    });
                }
            }
        });
    });

    // function to open detail transaction
    function openDetailTransaction(id, statuse, date) {

        $('#modal-lihat-transaksi').modal('show');
        $('#data-value-transaksi').hide();
        $('#data-value-transaksi-loading').show();
        $('#date-transaksi').html(date);
        $.ajax({
            url: '1_data/get_detail_transaction.php',
            type: 'POST',
            data: {
                id: id,
                statuse: statuse
            },
            success: function(response) {
                $('#data-value-transaksi-loading').hide();
                $('#data-value-transaksi').show();
                $('#data-value-transaksi').html(response);
            }
        });
    }

    // function to move bulan lalu
    $('#last-month-nav').click(function() {
        if (!$(this).hasClass('font-weight-bold')) {
            $(this).addClass('font-weight-bold').css({
                'color': 'black',
                'font-size': '1em'
            }).prop('disabled', true);
            $('#this-month-nav').removeClass('font-weight-bold').css({
                'color': 'darkgrey',
                'font-size': '1em'
            }).prop('disabled', false);
            $('#select-last-month').show();
            $('#input-page').trigger('click');
            getLastMonth();
            getKekayaanLastMonth();
            getDataReportByMonth();
        }
    });

    $('#this-month-nav').click(function() {
        if (!$(this).hasClass('font-weight-bold')) {
            $(this).addClass('font-weight-bold').css({
                'color': 'black',
                'font-size': '1em'
            }).prop('disabled', true);
            $('#last-month-nav').removeClass('font-weight-bold').css({
                'color': 'darkgrey',
                'font-size': '1em'
            }).prop('disabled', false);
            $('#input-page').trigger('click');
            $('#select-last-month').hide();
            getKekayaan();
            getDataReport();
        }
    });

    // function to get last month
    function getLastMonth() {
        var date = new Date();
        date.setMonth(date.getMonth() - 1);
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var lastMonth = year + '-' + month;
        $('#select-last-month').val(lastMonth);
    }

    // function to open modal lihat saldo
    $('#lihat-saldo').click(function() {
        $('#data-value-saldo').hide();
        $('#data-value-saldo-loading').show();
        $('#modal-lihat-saldo').modal('show');
        $.ajax({
            url: '1_data/get_saldo_resume.php',
            type: 'POST',
            success: function(response) {
                $('#data-value-saldo-loading').hide();
                $('#data-value-saldo').show();
                $('#data-value-saldo').html(response);
            }
        });
    });

    // function to delete transaction
    function deleteTransaction(id, statuse) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#category-transaction').prop('disabled', true);
                $('#method-transaction').prop('disabled', true);
                $('#nominal-transaction').prop('disabled', true);
                $('#detail-transaction').prop('disabled', true);
                $('#time-transaction').prop('disabled', true);
                $('#update-transaction').prop('disabled', true);

                $.ajax({
                    url: '1_data/delete_transaction.php',
                    type: 'POST',
                    data: {
                        id: id,
                        statuse: statuse
                    },
                    success: function(response) {
                        $('#category-transaction').prop('disabled', false);
                        $('#method-transaction').prop('disabled', false);
                        $('#nominal-transaction').prop('disabled', false);
                        $('#detail-transaction').prop('disabled', false);
                        $('#time-transaction').prop('disabled', false);
                        $('#update-transaction').prop('disabled', false);

                        if (response == 'success') {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            getDataReport();
                            getKekayaan();
                            $('#modal-lihat-transaksi').modal('hide');
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Data gagal dihapus.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    }

    // function to update transaction
    $('#update-transaction').click(function() {
        var id = $('#id-transaction').val();
        var category = $('#category-transaction').val();
        var methode = $('#method-transaction').val();
        var statuse = $('#statuse-transaction').val();
        var nominal = $('#nominal-transaction').val();
        var detail = $('#detail-transaction').val();
        var time = $('#time-transaction').val();
        if (!nominal) {
            $('#error-nominal-transaction').show();
            return;
        } else {
            $('#error-nominal-transaction').hide();
        }

        if (nominal <= 0) {
            $('#error-nominal-transaction2').show();
            return;
        } else {
            $('#error-nominal-transaction2').hide();
        }

        if (!detail) {
            $('#error-detail-transaction').show();
            return;
        } else {
            $('#error-detail-transaction').hide();
        }

        if (!detail.trim()) {
            $('#error-detail-transaction').show();
            return;
        } else {
            $('#error-detail-transaction').hide();
        }

        if (!time) {
            $('#error-time-transaction').show();
            return;
        } else {
            $('#error-time-transaction').hide();
        }

        var saldo = parseInt($('#saldo-transaction').val().replace(/,/g, ''));
        if (saldo - nominal < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: 'Saldo tidak mencukupi!',
            });
            return;
        }

        $('#category-transaction').prop('disabled', true);
        $('#method-transaction').prop('disabled', true);
        $('#nominal-transaction').prop('disabled', true);
        $('#detail-transaction').prop('disabled', true);
        $('#time-transaction').prop('disabled', true);
        $('#update-transaction').prop('disabled', true);


        $.ajax({
            url: '1_data/update_transaction.php',
            type: 'POST',
            data: {
                id: id,
                category: category,
                methode: methode,
                statuse: statuse,
                nominal: nominal,
                detail: detail,
                time: time
            },
            success: function(response) {
                $('#category-transaction').prop('disabled', false);
                $('#method-transaction').prop('disabled', false);
                $('#nominal-transaction').prop('disabled', false);
                $('#detail-transaction').prop('disabled', false);
                $('#time-transaction').prop('disabled', false);
                $('#update-transaction').prop('disabled', false);

                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diupdate',
                    });

                    if ($('#last-month-nav').hasClass('font-weight-bold')) {
                        getDataReportByMonth();
                        getKekayaanLastMonth();
                    } else {
                        getDataReport();
                        getKekayaan();
                    }

                    $('#modal-lihat-transaksi').modal('hide');
                }
            }
        });
    });

    // function to change input or laporan
    $('#input-page').click(function() {
        $('#input-page').removeClass('btn-primary').addClass('btn-secondary');
        $('#laporan-page').removeClass('btn-secondary').addClass('btn-primary');
        $('#cari-data-page').removeClass('btn-secondary').addClass('btn-primary');

        $('#input-page').prop('disabled', true);
        $('#laporan-page').prop('disabled', false);
        $('#cari-data-page').prop('disabled', false);

        $('#data-laporan').hide();
        $('#data-input').hide();
        $('#data-report').show();
        $('#add-data').show();
        $('#data-cari').hide();

    });

    $('#laporan-page').click(function() {
        $('#input-page').removeClass('btn-secondary').addClass('btn-primary');
        $('#laporan-page').removeClass('btn-primary').addClass('btn-secondary');
        $('#cari-data-page').removeClass('btn-secondary').addClass('btn-primary');

        $('#laporan-page').prop('disabled', true);
        $('#input-page').prop('disabled', false);
        $('#cari-data-page').prop('disabled', false);

        $('#data-laporan').show();
        $('#data-input').hide();
        $('#data-report').hide();
        $('#add-data').hide();
        $('#data-cari').hide();

        $('#laporan-balance').trigger('click');
    });

    $('#cari-data-page').click(function() {
        $('#input-page').removeClass('btn-secondary').addClass('btn-primary');
        $('#laporan-page').removeClass('btn-secondary').addClass('btn-primary');
        $('#cari-data-page').removeClass('btn-primary').addClass('btn-secondary');

        $('#laporan-page').prop('disabled', false);
        $('#input-page').prop('disabled', false);
        $('#cari-data-page').prop('disabled', true);

        $('#data-laporan').hide();
        $('#data-input').hide();
        $('#data-report').hide();
        $('#add-data').hide();
        $('#data-cari').show();
        $('#kata-kunci').val('');
        $('#data-cari-table').hide();

    });

    // function to trigger laporan balance in report last month
    function loadReportLastMonth() {
        $('#input-page').trigger('click');
    }

    $('#laporan-balance').click(function() {
        $('#laporan-balance').removeClass('btn-primary').addClass('btn-secondary').prop('disabled', true);
        $('#laporan-bar').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-pie').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-anggaran').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);

        if ($('#last-month-nav').hasClass('font-weight-bold')) {
            getDataChartLastMonth('balance');
        } else {
            getDataChart('balance');
        }
    });

    $('#laporan-bar').click(function() {
        $('#laporan-pie').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-balance').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-bar').removeClass('btn-primary').addClass('btn-secondary').prop('disabled', true);
        $('#laporan-anggaran').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);

        if ($('#last-month-nav').hasClass('font-weight-bold')) {
            getDataChartLastMonth('bare');
        } else {
            getDataChart('bare');
        }
    });

    $('#laporan-pie').click(function() {
        $('#laporan-pie').removeClass('btn-primary').addClass('btn-secondary').prop('disabled', true);
        $('#laporan-bar').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-balance').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-anggaran').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);

        if ($('#last-month-nav').hasClass('font-weight-bold')) {
            getDataChartLastMonth('bunder');
        } else {
            getDataChart('bunder');
        }
    });

    $('#laporan-anggaran').click(function() {
        $('#laporan-pie').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-bar').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-balance').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
        $('#laporan-anggaran').removeClass('btn-primary').addClass('btn-secondary').prop('disabled', true);

        if ($('#last-month-nav').hasClass('font-weight-bold')) {
            getDataChartLastMonth('anggaran');
        } else {
            getDataChart('anggaran');
        }
    });

    // function to get data chart
    function getDataChart(jenis_chart) {
        $('#data-laporan-chart').hide();
        $('#data-laporan-chart-loading').show();
        $.ajax({
            url: '1_data/get_chart.php',
            type: 'POST',
            data: {
                jenis_chart: jenis_chart
            },
            success: function(response) {
                $('#data-laporan-chart').show();
                $('#data-laporan-chart-loading').hide();
                $('#data-laporan-chart').html(response);
            }
        });
    }

    // function to get data chart last month
    function getDataChartLastMonth(jenis_chart) {
        $('#data-laporan-chart').hide();
        $('#data-laporan-chart-loading').show();
        var monthe = $('#select-last-month').val();
        $.ajax({
            url: '1_data/get_chart.php',
            type: 'POST',
            data: {
                jenis_chart: jenis_chart,
                bulan: monthe
            },
            success: function(response) {
                $('#data-laporan-chart').show();
                $('#data-laporan-chart-loading').hide();
                $('#data-laporan-chart').html(response);
            }
        });
    }

    // function to get data cari
    $('#kata-kunci').keyup(function() {
        var kata_kunci = $(this).val();
        if (kata_kunci.length > 0) {
            $('#data-cari-loading').show();
            $('#data-cari-table').hide();
            $.ajax({
                url: '1_data/get_cari.php',
                type: 'POST',
                data: {
                    kata_kunci: kata_kunci
                },
                success: function(response) {
                    $('#data-cari-loading').hide();
                    $('#data-cari-table').show();
                    $('#data-cari-table').html(response);
                }
            });
        } else {
            $('#data-cari-table').hide();
        }
    });
</script>