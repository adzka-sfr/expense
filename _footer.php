<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Update the date
        setInterval(updateDateTime, 1000); // Update every second
        updateDateTime(); // Initial call
    });

    // function untuk menampilkan tanggal
    function updateDateTime() {
        var now = new Date();
        var options = {
            weekday: 'long',
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        };
        var formattedDate = now.toLocaleDateString('id-ID', options).replace('.', '');

        var hours = String(now.getHours()).padStart(2, '0'); // Ensure 2-digit format
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');
        var timeString = hours + ":" + minutes + ":" + seconds;

        $("#current-date-time").text(formattedDate + " " + timeString);
    }

    // Logout
    $("#logout-link").click(function() {
        Swal.fire({
            title: 'Keluar',
            text: 'Apakah anda yakin akan keluar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yoi, keluar',
            cancelButtonText: 'Ngga deh'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../auth/act_logout.php";
            }
        });
    });

    // Select2
    $('.search-biasa').select2({
        placeholder: "Pilih salah satu",
        allowClear: false,
        language: "id"
    });

    // function to limit the input just number
    function validateInputJustNumber(event) {
        const input = event.target.value;
        const regex = /^[0-9.]*$/; // Regular expression to match numbers and dots
        if (!regex.test(input)) {
            event.target.value = input.slice(0, -1); // Remove the last character if it's not a number or dot
        }
    }
</script>
</body>

</html>