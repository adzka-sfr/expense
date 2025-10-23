<div class="card mb-3 mt-3 mb-5" style="padding-left: 0px; padding-right: 0px; margin-bottom: 50px;">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h5 class="card-title">Anggaran</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <input type="month" name="month" id="month" class="form-control" value="<?php echo date('Y-m'); ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3" id="data-value-budget" style="display: none;">

            </div>
            <div class="col-12 mt-3 text-center" id="data-value-budget-loading">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="modal fade" id="modal-tambah-anggaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Buat anggaran - <b id="month-label"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <select class="search-biasa" style="width: 100%;" name="cat-budget" onchange="turnOnNominal()" id="cat-budget">
                            </select>
                            <span id="error-cat-budget" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan pilih kategori</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Nominal</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon3">Rp</span>
                                <input type="number" style="text-align: right;" disabled class="form-control" oninput="validateInputJustNumber(event)" id="nominal-budget" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <span id="error-nominal-budget" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal harus diisi</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" id="save-budget" class="btn btn-primary btn-sm">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-anggaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit anggaran - <b id="month-label-edit"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <input type="text" name="budget-name" id="budget-name" class="form-control" disabled>
                            <input type="hidden" name="budget-id" id="budget-id">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Nominal</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon3">Rp</span>
                                <input type="number" disabled class="form-control" oninput="validateInputJustNumber(event)" id="nominal-budget-edit" aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <span id="error-nominal-budget-edit" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nominal harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-danger btn-sm" id="delete-budget">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" id="save-budget-edit" class="btn btn-primary btn-sm">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getBudget();

        $('#month').change(function() {
            getBudget();
        });
    });

    // function when month is changed
    function getBudget() {
        var month = $('#month').val();
        $('#data-value-budget').hide();
        $('#data-value-budget-loading').show();
        $.ajax({
            url: '3_data/act_get_budget.php',
            type: 'POST',
            data: {
                month: month
            },
            success: function(data) {
                $('#data-value-budget-loading').hide();
                $('#data-value-budget').show();
                $('#data-value-budget').html(data);
            }
        });
    }

    // function when add budget button is clicked
    function tambahAnggaran(month) {
        var options = {
            year: 'numeric',
            month: 'long'
        };
        var formattedMonth = new Date(month + '-01').toLocaleDateString('en-US', options);
        $('#month-label').html(formattedMonth);
        $('#nominal-budget').val('');
        $('#nominal-budget').prop('disabled', true);
        $('#modal-tambah-anggaran').modal('show');
        $('#modal-tambah-anggaran').on('shown.bs.modal', function() {
            getCategory();
        });
    }

    // function to get category
    function getCategory() {
        var type = 'pengeluaran';
        var monthe = $('#month').val();
        $.ajax({
            url: '3_data/get_category.php',
            type: 'POST',
            data: {
                type: type,
                monthe: monthe
            },
            success: function(data) {
                $('#cat-budget').html(data);
                $('#cat-budget').select2({
                    dropdownParent: $('#modal-tambah-anggaran'),
                    placeholder: 'Pilih salah satu',
                    allowClear: false
                });
            }
        });
    }

    // function to turn on nominal
    function turnOnNominal() {
        $('#nominal-budget').prop('disabled', false);
        $('#error-cat-budget').hide();
        $('#error-nominal-budget').hide();
        $('#nominal-budget').val('');
        $('#nominal-budget').focus();
    }

    // function to save budget
    $('#save-budget').click(function() {
        var month = $('#month').val();
        var cat = $('#cat-budget').val();
        var nominal = $('#nominal-budget').val();

        $('#error-cat-budget').hide();
        $('#error-nominal-budget').hide();

        if (cat === '') {
            $('#error-cat-budget').show();
        } else if (nominal === '' || nominal <= 0) {
            $('#error-nominal-budget').show();
        } else {
            $('#cat-budget').prop('disabled', true);
            $('#nominal-budget').prop('disabled', true);
            $('#save-budget').prop('disabled', true);

            $.ajax({
                url: '3_data/act_set_budget.php',
                type: 'POST',
                data: {
                    month: month,
                    cat: cat,
                    nominal: nominal
                },
                success: function(data) {
                    $('#cat-budget').prop('disabled', false);
                    $('#nominal-budget').prop('disabled', false);
                    $('#save-budget').prop('disabled', false);

                    if (data == 'success') {
                        $('#modal-tambah-anggaran').modal('hide');
                        $('#nominal-budget').prop('disabled', true);
                        $('#nominal-budget').val('');
                        getBudget();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Anggaran berhasil disimpan',
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menyimpan anggaran',
                        });
                    }
                }
            });
        }
    });

    // function to edit budget
    function editBudget(id, name, nominal) {
        var options = {
            year: 'numeric',
            month: 'long'
        };
        var month = $('#month').val();
        var formattedMonth = new Date(month + '-01').toLocaleDateString('en-US', options);
        $('#month-label-edit').html(formattedMonth);
        $('#budget-name').val(name);
        $('#nominal-budget-edit').val(nominal);
        $('#nominal-budget-edit').prop('disabled', false);
        $('#error-nominal-budget-edit').hide();
        $('#budget-id').val(id);
        $('#modal-edit-anggaran').modal('show');
    }

    // function to save budget edit
    $('#save-budget-edit').click(function() {
        var id = $('#budget-id').val();
        var nominal = $('#nominal-budget-edit').val();

        $('#error-nominal-budget-edit').hide();

        if (nominal === '' || nominal <= 0) {
            $('#error-nominal-budget-edit').show();
        } else {
            $('#nominal-budget-edit').prop('disabled', true);
            $('#delete-budget').prop('disabled', true);
            $('#save-budget-edit').prop('disabled', true);

            $.ajax({
                url: '3_data/act_edit_budget.php',
                type: 'POST',
                data: {
                    id: id,
                    nominal: nominal
                },
                success: function(data) {
                    $('#nominal-budget-edit').prop('disabled', false);
                    $('#delete-budget').prop('disabled', false);
                    $('#save-budget-edit').prop('disabled', false);

                    if (data == 'success') {
                        $('#modal-edit-anggaran').modal('hide');
                        $('#nominal-budget-edit').prop('disabled', true);
                        $('#nominal-budget-edit').val('');
                        getBudget();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Anggaran berhasil diedit',
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menyimpan anggaran, harap reload halaman',
                        });
                    }
                }
            });
        }
    });

    // function to delete budget
    $('#delete-budget').click(function() {
        var id = $('#budget-id').val();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#nominal-budget-edit').prop('disabled', true);
                $('#delete-budget').prop('disabled', true);
                $('#save-budget-edit').prop('disabled', true);

                $.ajax({
                    url: '3_data/act_delete_budget.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#nominal-budget-edit').prop('disabled', false);
                        $('#delete-budget').prop('disabled', false);
                        $('#save-budget-edit').prop('disabled', false);

                        if (data == 'success') {
                            $('#modal-edit-anggaran').modal('hide');
                            getBudget();
                            Swal.fire(
                                'Terhapus!',
                                'Anggaran berhasil dihapus.',
                                'success'
                            );
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menghapus anggaran, harap reload halaman',
                            });
                        }
                    }
                });
            }
        });
    });
</script>