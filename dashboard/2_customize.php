<div class="card mb-3 mt-3" style="padding-left: 0px; padding-right: 0px;">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h5 class="card-title">Kategori</h5>
            </div>
            <div class="col-2 text-end">
                <button type="button" id="add-category" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3" id="data-value-category" style="display: none;">

            </div>
            <div class="col-12 mt-3 text-center" id="data-value-category-loading">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 mt-3 mb-5" style="padding-left: 0px; padding-right: 0px; margin-bottom: 50px;">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h5 class="card-title">Metode Pembayaran</h5>
            </div>
            <div class="col-2 text-end">
                <button type="button" id="add-method" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3" id="data-value-method" style="display: none;">

            </div>
            <div class="col-12 mt-3 text-center" id="data-value-method-loading">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<hr>

<!-- modal tambah kategori -->
<div class="modal fade" id="modal-tambah-kategori" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group input-group-sm">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="cat-name" id="cat-name">
                            <span id="error-cat-name" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Nama tidak boleh kosong</span>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="retain-capital" name="retain-capital">
                            <label class="form-check-label" for="retain-capital">
                                Pertahankan kapital
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="form-group input-group-sm">
                            <label for="cat-type">Jenis</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cat-type" id="cat-type-pengeluaran" value="pengeluaran">
                                <label class="form-check-label" for="cat-type-pengeluaran">
                                    Pengeluaran
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cat-type" id="cat-type-pemasukan" value="pemasukan">
                                <label class="form-check-label" for="cat-type-pemasukan">
                                    Pemasukan
                                </label>
                            </div>
                            <span id="error-type" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan pilih salah satu</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Icon</label>
                            <select class="search-biasa" style="width: 100%;" name="cat-icon" id="cat-icon">
                            </select>
                            <span id="error-cat-icon" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan pilih icon</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 text-center">
                        <i id="selected-icon" class="fa-solid fa-icons" style="font-size: 1.5em;"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="save-category" class="btn btn-primary btn-sm">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah metode -->
<div class="modal fade" id="modal-tambah-metode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Metode Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group input-group-sm">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="method-name" id="method-name">
                            <span id="error-method-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Nama tidak boleh kosong</span>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="retain-capital-method" name="retain-capital-method">
                            <label class="form-check-label" for="retain-capital-method">
                                Pertahankan kapital
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="save-method" class="btn btn-primary btn-sm">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal action kategori -->
<div class="modal fade" id="modal-edit-kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" name="edit-cat-id" id="edit-cat-id">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group input-group-sm">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="edit-cat-name" id="edit-cat-name">
                            <span id="error-edit-cat-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Nama tidak boleh kosong</span>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="edit-retain-capital" name="edit-retain-capital">
                            <label class="form-check-label" for="edit-retain-capital">
                                Pertahankan kapital
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="form-group input-group-sm">
                            <label for="cat-type">Jenis</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="edit-cat-type" id="edit-cat-type-pengeluaran" value="pengeluaran">
                                <label class="form-check-label" for="edit-cat-type-pengeluaran">
                                    Pengeluaran
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="edit-cat-type" id="edit-cat-type-pemasukan" value="pemasukan">
                                <label class="form-check-label" for="edit-cat-type-pemasukan">
                                    Pemasukan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih untuk mengganti icon</label>
                            <select class="search-biasa" style="width: 100%;" name="cat-icon-edit" id="cat-icon-edit">
                            </select>
                            <span id="error-cat-icon-edit" style="color: #DC3545; display: none; font-size:0.7em"><i class="fa-solid fa-circle-info"></i> Silahkan pilih icon</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 text-center">
                        <i id="selected-icon-edit" class="fa-solid fa-icons" style="font-size: 1.5em;"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="form-group input-group-sm">
                            <label for="edit-status">Status</label>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="edit-status" name="edit-status">
                                <label class="form-check-label" for="edit-status">
                                    Gunakan pada aplikasi
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="delete-category" class="btn btn-danger btn-sm">
                    Hapus
                </button>
                <button type="button" id="save-edit-category" class="btn btn-primary btn-sm">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal action metode -->
<div class="modal fade" id="modal-edit-metode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Metode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" name="edit-method-id" id="edit-method-id">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group input-group-sm">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="edit-method-name" id="edit-method-name">
                            <span id="error-edit-method-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Nama tidak boleh kosong</span>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="edit-retain-capital-method" name="edit-retain-capital-method">
                            <label class="form-check-label" for="edit-retain-capital-method">
                                Pertahankan kapital
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="edit-status-method" name="edit-status-method">
                            <label class="form-check-label" for="edit-status-method">
                                Gunakan pada aplikasi
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="delete-method" class="btn btn-danger btn-sm">
                    Hapus
                </button>
                <button type="button" id="save-edit-method" class="btn btn-primary btn-sm">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(" #add-category").click(function() {
            $('#modal-tambah-kategori').modal('show');
            $('#cat-name').val('');
            $('#retain-capital').prop('checked', false);
            $("input[name='cat-type']").prop('checked', false);
            $('#error-cat-name').hide();
            $('#error-type').hide();
            $('#error-cat-icon').hide();
            getIconList();
        });

        $("#add-method").click(function() {
            $('#modal-tambah-metode').modal('show');
            $('#method-name').val('');
            $('#retain-capital-method').prop('checked', false);
            $('#error-method-name').hide();
        });

        getCategory();
        getMethod();
    });

    // function to save category
    $("#save-category").click(function() {
        var catName = $("#cat-name").val();
        var catType = $("input[name='cat-type' ]:checked").val();
        var retainCapital = $("#retain-capital").is(":checked");
        var icon = $("#cat-icon").val();

        // Reset error messages
        $("#error-cat-name").hide();
        $("#error-type").hide();
        $('#error-cat-icon').hide();

        if ($.trim(catName) == "") {
            $("#error-cat-name").show();
        } else if (catType == undefined) {
            $("#error-type").show();
        } else if (icon == "") {
            $('#error-cat-icon').show();
        } else {
            $('#cat-name').prop('disabled', true);
            $('#retain-capital').prop('disabled', true);
            $("input[name='cat-type']").prop('disabled', true);
            $('#cat-icon').prop('disabled', true);
            $('#save-category').prop('disabled', true);

            $.ajax({
                url: "2_data/act_add_category.php",
                type: "POST",
                data: {
                    catName: catName,
                    catType: catType,
                    retainCapital: retainCapital,
                    icon: icon
                },
                success: function(response) {
                    $('#cat-name').prop('disabled', false);
                    $('#retain-capital').prop('disabled', false);
                    $("input[name='cat-type']").prop('disabled', false);
                    $('#cat-icon').prop('disabled', false);
                    $('#save-category').prop('disabled', false);

                    if (response == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Kategori berhasil ditambahkan!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#cat-name').val('');
                                $('#retain-capital').prop('checked', false);
                                $("input[name='cat-type']").prop('checked', false);
                                $('#modal-tambah-kategori').modal('hide');
                                getCategory();
                            }
                        });
                    } else if (response == "cookie_expired") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sesi telah berakhir, silahkan login kembali!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else if (response == "exist") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Kategori sudah ada!',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menambahkan kategori!',
                        });
                    }
                }
            });
        }
    });

    // function to save method
    $("#save-method").click(function() {
        var methodName = $("#method-name").val();
        var retainCapital = $("#retain-capital-method").is(":checked");

        // Reset error messages
        $("#error-method-name").hide();

        if ($.trim(methodName) == "") {
            $("#error-method-name").show();
        } else {
            $('#method-name').prop('disabled', true);
            $('#retain-capital-method').prop('disabled', true);
            $('#save-method').prop('disabled', true);

            $.ajax({
                url: "2_data/act_add_method.php",
                type: "POST",
                data: {
                    methodName: methodName,
                    retainCapital: retainCapital
                },
                success: function(response) {
                    $('#method-name').prop('disabled', false);
                    $('#retain-capital-method').prop('disabled', false);
                    $('#save-method').prop('disabled', false);

                    if (response == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Metode pembayaran berhasil ditambahkan!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#method-name").val('');
                                $("#retain-capital-method").prop('checked', false);
                                $('#modal-tambah-metode').modal('hide');
                                getMethod();
                            }
                        });
                    } else if (response == "cookie_expired") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sesi telah berakhir, silahkan login kembali!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else if (response == "exist") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Metode pembayaran sudah ada!',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menambahkan metode pembayaran!',
                        });
                    }
                }
            });
        }
    });

    // function to get data category
    function getCategory() {
        $('#data-value-category').hide();
        $('#data-value-category-loading').show();
        $.ajax({
            url: "2_data/act_get_category.php",
            type: "POST",
            success: function(response) {
                $('#data-value-category').show();
                $('#data-value-category-loading').hide();
                $("#data-value-category").html(response);
            }
        });
    }

    // function to get data method
    function getMethod() {
        $('#data-value-method').hide();
        $('#data-value-method-loading').show();
        $.ajax({
            url: "2_data/act_get_method.php",
            type: "POST",
            success: function(response) {
                $('#data-value-method').show();
                $('#data-value-method-loading').hide();
                $("#data-value-method").html(response);
            }
        });
    }

    // function to edit category
    function editCategory(id, name, type, status, icon) {
        // set value
        $('#edit-cat-id').val(id);
        $('#edit-cat-name').val(name);
        if (type == 'pengeluaran') {
            $('#edit-cat-type-pengeluaran').prop('checked', true).prop('disabled', true);
            $('#edit-cat-type-pemasukan').prop('disabled', true);
        } else {
            $('#edit-cat-type-pemasukan').prop('checked', true).prop('disabled', true);
            $('#edit-cat-type-pengeluaran').prop('disabled', true);
        }
        if (status == 'active') {
            $('#edit-status').prop('checked', true);
        } else {
            $('#edit-status').prop('checked', false);
        }

        $("#selected-icon-edit").attr('class', icon);

        getIconListEdit();

        // open modal
        $('#modal-edit-kategori').modal('show');
    }

    // function to save edit category
    $("#save-edit-category").click(function() {
        var catId = $("#edit-cat-id").val();
        var catName = $("#edit-cat-name").val();
        var retainCapital = $("#edit-retain-capital").is(":checked");
        var catStatus = $("#edit-status").is(":checked");
        var catIcon = $("#cat-icon-edit").val();

        // Reset error messages
        $("#error-edit-cat-name").hide();

        if ($.trim(catName) == "") {
            $("#error-edit-cat-name").show();
        } else {
            $('#edit-cat-name').prop('disabled', true);
            $('#edit-retain-capital').prop('disabled', true);
            $("input[name='edit-cat-type']").prop('disabled', true);
            $('#edit-status').prop('disabled', true);
            $('#save-edit-category').prop('disabled', true);
            $('#delete-category').prop('disabled', true);
            $('#cat-icon-edit').prop('disabled', true);

            $.ajax({
                url: "2_data/act_edit_category.php",
                type: "POST",
                data: {
                    catId: catId,
                    catName: catName,
                    retainCapital: retainCapital,
                    catStatus: catStatus,
                    catIcon: catIcon
                },
                success: function(response) {
                    $('#edit-cat-name').prop('disabled', false);
                    $('#edit-retain-capital').prop('disabled', false);
                    $("input[name='edit-cat-type']").prop('disabled', false);
                    $('#edit-status').prop('disabled', false);
                    $('#save-edit-category').prop('disabled', false);
                    $('#delete-category').prop('disabled', false);
                    $('#cat-icon-edit').prop('disabled', false);

                    if (response == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Kategori berhasil diubah!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#edit-cat-name').val('');
                                $('#edit-retain-capital').prop('checked', false);
                                $("input[name='edit-cat-type']").prop('checked', false);
                                $('#edit-status').prop('checked', false);
                                $('#modal-edit-kategori').modal('hide');
                                getCategory();
                            }
                        });
                    } else if (response == "cookie_expired") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sesi telah berakhir, silahkan login kembali!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat mengubah kategori!',
                        });
                    }
                }
            });
        }
    });

    // function to edit method
    function editMethod(id, name, status) {
        // set value
        $('#edit-method-id').val(id);
        $('#edit-method-name').val(name);
        if (status == 'active') {
            $('#edit-status-method').prop('checked', true);
        } else {
            $('#edit-status-method').prop('checked', false);
        }
        // open modal
        $('#modal-edit-metode').modal('show');
    }

    // function to save edit method
    $("#save-edit-method").click(function() {
        var methodId = $("#edit-method-id").val();
        var methodName = $("#edit-method-name").val();
        var retainCapital = $("#edit-retain-capital-method").is(":checked");
        var methodStatus = $("#edit-status-method").is(":checked");

        // Reset error messages
        $("#error-edit-method-name").hide();

        if ($.trim(methodName) == "") {
            $("#error-edit-method-name").show();
        } else {
            $('#edit-method-name').prop('disabled', true);
            $('#edit-retain-capital-method').prop('disabled', true);
            $('#edit-status-method').prop('disabled', true);
            $('#save-edit-method').prop('disabled', true);
            $('#delete-method').prop('disabled', true);

            $.ajax({
                url: "2_data/act_edit_method.php",
                type: "POST",
                data: {
                    methodId: methodId,
                    methodName: methodName,
                    retainCapital: retainCapital,
                    methodStatus: methodStatus
                },
                success: function(response) {
                    $('#edit-method-name').prop('disabled', false);
                    $('#edit-retain-capital-method').prop('disabled', false);
                    $('#edit-status-method').prop('disabled', false);
                    $('#save-edit-method').prop('disabled', false);
                    $('#delete-method').prop('disabled', false);

                    if (response == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Metode pembayaran berhasil diubah!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#edit-method-name').val('');
                                $('#edit-retain-capital-method').prop('checked', false);
                                $('#edit-status-method').prop('checked', false);
                                $('#modal-edit-metode').modal('hide');
                                getMethod();
                            }
                        });
                    } else if (response == "cookie_expired") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sesi telah berakhir, silahkan login kembali!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat mengubah metode pembayaran!',
                        });
                    }
                }
            });
        }
    });

    // function to delete category
    $("#delete-category").click(function() {
        var catId = $("#edit-cat-id").val();

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Penghapusan hanya bisa dilakukan jika tidak ada transaksi yang menggunakan kategori ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#edit-cat-name').prop('disabled', true);
                $('#edit-retain-capital').prop('disabled', true);
                $("input[name='edit-cat-type']").prop('disabled', true);
                $('#edit-status').prop('disabled', true);
                $('#save-edit-category').prop('disabled', true);
                $('#delete-category').prop('disabled', true);

                $.ajax({
                    url: "2_data/act_delete_category.php",
                    type: "POST",
                    data: {
                        catId: catId
                    },
                    success: function(response) {
                        $('#edit-cat-name').prop('disabled', false);
                        $('#edit-retain-capital').prop('disabled', false);
                        $("input[name='edit-cat-type']").prop('disabled', false);
                        $('#edit-status').prop('disabled', false);
                        $('#save-edit-category').prop('disabled', false);
                        $('#delete-category').prop('disabled', false);

                        if (response == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Kategori berhasil dihapus!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#modal-edit-kategori').modal('hide');
                                    getCategory();
                                }
                            });
                        } else if (response == "used") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Kategori tidak bisa dihapus karena sudah digunakan dalam transaksi!',
                            });
                        } else if (response == "cookie_expired") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Sesi telah berakhir, silahkan login kembali!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menghapus kategori!',
                            });
                        }
                    }
                });
            }
        });
    });

    // function to delete method
    $("#delete-method").click(function() {
        var methodId = $("#edit-method-id").val();

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Penghapusan hanya bisa dilakukan jika tidak ada transaksi yang menggunakan metode ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#edit-method-name').prop('disabled', true);
                $('#edit-retain-capital-method').prop('disabled', true);
                $('#edit-status-method').prop('disabled', true);
                $('#save-edit-method').prop('disabled', true);
                $('#delete-method').prop('disabled', true);

                $.ajax({
                    url: "2_data/act_delete_method.php",
                    type: "POST",
                    data: {
                        methodId: methodId
                    },
                    success: function(response) {
                        $('#edit-method-name').prop('disabled', false);
                        $('#edit-retain-capital-method').prop('disabled', false);
                        $('#edit-status-method').prop('disabled', false);
                        $('#save-edit-method').prop('disabled', false);
                        $('#delete-method').prop('disabled', false);

                        if (response == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Metode pembayaran berhasil dihapus!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#modal-edit-metode').modal('hide');
                                    getMethod();
                                }
                            });
                        } else if (response == "used") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Metode pembayaran tidak bisa dihapus karena sudah digunakan dalam transaksi!',
                            });
                        } else if (response == "cookie_expired") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Sesi telah berakhir, silahkan login kembali!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menghapus metode pembayaran!',
                            });
                        }
                    }
                });
            }
        });
    });

    // function to get list icon
    function getIconList() {
        $('#cat-icon').prop('disabled', true);
        $.ajax({
            url: "2_data/act_get_icon.php",
            type: "POST",
            success: function(response) {
                $('#cat-icon').prop('disabled', false);
                $("#cat-icon").html(response);
                // Initialize select2 after loading the icons
                $('#cat-icon').select2({
                    dropdownParent: $('#modal-tambah-kategori')
                });
            }
        });
    }

    // function to get list icon
    function getIconListEdit() {
        $('#cat-icon-edit').prop('disabled', true);
        $.ajax({
            url: "2_data/act_get_icon.php",
            type: "POST",
            success: function(response) {
                $('#cat-icon-edit').prop('disabled', false);
                $("#cat-icon-edit").html(response);
                // Initialize select2 after loading the icons
                $('#cat-icon-edit').select2({
                    dropdownParent: $('#modal-edit-kategori')
                });
            }
        });
    }

    // function to preview icon
    $("#cat-icon").change(function() {
        var icon = $("#cat-icon").val();
        $("#selected-icon").attr('class', 'fa-solid ' + icon);
    });

    // function to preview icon edit
    $("#cat-icon-edit").change(function() {
        var icon = $("#cat-icon-edit").val();
        $("#selected-icon-edit").attr('class', 'fa-solid ' + icon);
    });
</script>