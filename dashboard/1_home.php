<div class="card mb-4" style="padding-left: 0px; padding-right: 0px;">
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-12 text-center" style="color:darkgrey; font-size: 1em;">
                Total Pengeluaran Bulan Ini
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-0">
                <h3 id='spend' class="mb-0"><sup>Rp</sup>35.000</h3>
                <!-- <h3 id="spend-loading"><i class="fa-solid fa-circle-notch fa-spin"></i></h3> -->
            </div>
        </div>
    </div>
</div>


<div class="card mb-4 card-floating" style="padding-left: 0px; padding-right: 0px; position:fixed; bottom: 20px; width: 100%;">
    <div class="card-body">
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
                    <input class="form-control form-control-sm" type="text" name="nominal" id="nominal" oninput="validateInputJustNumber(event);">
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
                console.log('simpan berhasil');

            }
        });

    });
</script>