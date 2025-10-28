<div class="card mb-2" style="padding-left: 0px; padding-right: 0px;">
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-12 text-center mb-2" style="color:darkgrey; font-size: 1em;">
                Pengeluaran Bulan
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <input type="month" class="form-control">
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

<script>
    // document ready
    $(document).ready(function() {
        setLastMonth();
        getDataTransaction();
        getResumeSpend();
        getDataPercentage();
    });

    // function to set month as last month
    function setLastMonth() {
        const date = new Date();
        date.setMonth(date.getMonth() - 1);
        const month = date.toISOString().slice(0, 7);
        $('input[type="month"]').val(month);
    }

    // event on change month input
    $('input[type="month"]').on('change', function() {
        getDataTransaction();
        getResumeSpend();
        getDataPercentage();
    });

    // function to get data transaction
    function getDataTransaction() {
        var month = $('input[type="month"]').val();
        $.ajax({
            url: '2_data/get_report.php',
            type: 'POST',
            data: {
                month: month
            },
            success: function(response) {
                $('#data-transaction').html(response);
            }
        });
    }

    // function to get resume spend
    function getResumeSpend() {
        var month = $('input[type="month"]').val();
        $.ajax({
            url: '2_data/get_resume.php',
            type: 'POST',
            data: {
                month: month
            },
            success: function(response) {
                $('#spend').html('<sup>Rp</sup>' + parseInt(response).toLocaleString('id-ID'));
            }
        });
    }

    // function to get data percentage
    function getDataPercentage() {
        var month = $('input[type="month"]').val();
        $.ajax({
            url: '2_data/get_resume_table.php',
            type: 'POST',
            data: {
                month: month
            },
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
                    url: '2_data/delete_transaction.php',
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