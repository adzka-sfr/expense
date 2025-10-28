<div class="card mb-2" style="padding-left: 0px; padding-right: 0px;">
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-12 text-center mb-2" style="color:darkgrey; font-size: 1em;">
                Total Pengeluaran Bulan Ini
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-0">
                <h3 id='spend' class="mb-0"><sup>Rp</sup>0</h3>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12" id="data-percentage">
            </div>
        </div>
    </div>
</div>

<div class="col-12" id="data-transaction" style="padding-left: 0px; padding-right: 0px; font-size: 0.7em;">
</div>


<div class="card mb-4 card-floating" style="padding-left: 0px; padding-right: 0px; position:fixed; bottom: 20px; width: 100%; ">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <span id="label-success" class="text-success" style="display: none;"><i class="fa-solid fa-clipboard-check"></i> Data berhasil disimpan!!!</span>
                <span id="label-fail" class="text-danger" style="display: none;"><i class="fa-solid fa-square-xmark"></i> Data gagal disimpan!!!</span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input class="form-control form-control-sm" type="datetime-local" name="today-date" id="today-date">
                    <span id="error-today-date" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Harus isi</span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kategori</label>
                    <select class="search-biasa" style="width: 100%;" name="category" id="category">
                    </select>
                    <span id="error-category" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Harus isi</span>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nominal</label>
                    <input class="form-control form-control-sm" type="number" name="nominal" id="nominal" oninput="validateInputJustNumber(event);">
                    <span id="error-nominal" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Harus isi</span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Detail</label>
                    <input class="form-control form-control-sm" type="text" name="detail" id="detail">
                    <span id="error-detail" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Harus isi</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <button class="btn btn-primary btn-sm btn-block" id="save-expense" style="width: 100%;">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    // document ready
    $(document).ready(function() {
        // Set the current date and time in the input field
        $('#today-date').val(getCurrentDateTimeLocal());
        // get category list
        getCategoryList();
        getDataTransaction();
        getResumeSpend();
        getDataPercentage();
    });

    // function to get current date and time
    function getCurrentDateTimeLocal() {
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        var day = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');

        return year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    }

    // function to get list category
    function getCategoryList() {
        $.ajax({
            url: '1_data/get_category.php',
            type: 'POST',
            success: function(response) {
                $('#category').html(response);
            }
        });
    }

    // function when button save expense clicked
    $('#save-expense').click(function() {

        var todayDate = $('#today-date').val();
        var category = $('#category').val();
        var nominal = $('#nominal').val();
        var detail = $('#detail').val();
        var hasError = false;
        // reset error
        $('#error-today-date').hide();
        $('#error-category').hide();
        $('#error-nominal').hide();
        $('#error-detail').hide();
        // validate input
        if (todayDate === '') {
            $('#error-today-date').show();
            // close after 3 seconds
            setTimeout(function() {
                $('#error-today-date').hide();
            }, 3000);
            hasError = true;
        }
        if (category === '') {
            $('#error-category').show();
            setTimeout(function() {
                $('#error-category').hide();
            }, 3000);
            hasError = true;
        }
        if (nominal === '') {
            $('#error-nominal').show();
            setTimeout(function() {
                $('#error-nominal').hide();
            }, 3000);
            hasError = true;
        }
        if (detail === '') {
            $('#error-detail').show();
            setTimeout(function() {
                $('#error-detail').hide();
            }, 3000);
            hasError = true;
        }
        if (hasError) {
            return;
        }

        $('#save-expense').prop('disabled', true);
        // if no error, submit form via ajax
        $.ajax({
            url: '1_data/save_outcome.php',
            type: 'POST',
            data: {
                time: todayDate,
                category: category,
                nominal: nominal,
                detail: detail
            },
            success: function(response) {

                if (response === 'success') {
                    $('#label-success').show();
                    $('#label-fail').hide();
                    // close after 3 seconds
                    setTimeout(function() {
                        $('#label-success').hide();
                    }, 3000);
                    // reset form
                    $('#today-date').val(getCurrentDateTimeLocal());
                    $('#category').val('').trigger('change');
                    $('#nominal').val('');
                    $('#detail').val('');
                    $('#save-expense').prop('disabled', false);
                    getDataTransaction();
                    getResumeSpend();
                    getDataPercentage();
                } else {
                    $('#label-fail').show();
                    $('#label-success').hide();
                    // close after 3 seconds
                    $('#save-expense').prop('disabled', false);
                    setTimeout(function() {
                        $('#label-fail').hide();
                    }, 3000);
                }
            }
        });

    });

    // function to get data transaction
    function getDataTransaction() {
        $.ajax({
            url: '1_data/get_report.php',
            type: 'POST',
            success: function(response) {
                $('#data-transaction').html(response);
            }
        });
    }

    // function to get resume spend
    function getResumeSpend() {
        $.ajax({
            url: '1_data/get_resume.php',
            type: 'POST',
            success: function(response) {
                $('#spend').html('<sup>Rp</sup>' + parseInt(response).toLocaleString('id-ID'));
            }
        });
    }

    // function to get data percentage
    function getDataPercentage() {
        $.ajax({
            url: '1_data/get_resume_table.php',
            type: 'POST',
            success: function(response) {
                $('#data-percentage').html(response);
            }
        });
    }

    // function to delete transaction
    function deleteTransaction(id, category, detail, datetime) {
        Swal.fire({
            title: 'Hapus data ?',
            icon: 'question',
            html: '<table style="text-align: left; margin: auto;"><tr><td><b>Kategori</b></td><td>:</td><td>' + category + '</td></tr><tr><td><b>Detail</b></td><td>:</td><td>' + detail + '</td></tr><tr><td><b>Tanggal</b></td><td>:</td><td>' + datetime + '</td></tr></table>',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // run ajax in here if result oke
                $.ajax({
                    url: '1_data/delete_transaction.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire(
                                'Berhasil',
                                'Data berhasil dihapus',
                                'success'
                            );
                            getDataTransaction();
                            getResumeSpend();
                            getDataPercentage();
                        } else {
                            Swal.fire(
                                'Gagal',
                                'Data gagal dihapus',
                                'error'
                            );
                        }
                    }
                });

            }
        });
    }
</script>