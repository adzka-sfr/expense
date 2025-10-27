<?php
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



// Assuming $user['theme'] is already set and contains the color code
$themeColor = isset($user['theme']) ? $user['theme'] : '#007bff'; // Default to blue if not set
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense</title>
    <link rel="icon" href="<?php echo base_url('assets/images/robot_face.png'); ?>" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- ECharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
    <style>
        body {
            /* font-family: 'Google Sans', sans-serif; */
            font-family: 'Roboto', sans-serif;
            background-color: #F2F2F7;
            /* font-family: 'San Francisco', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; */
        }

        .footer .row {
            display: flex;
            justify-content: space-between;
            margin: 0;
            padding: 0;
        }

        .footer .col {
            padding: 0;
        }

        .footer .nav-link {
            display: block;
            text-align: center;
            width: 100%;
            padding: 10px 0;
        }

        .footer .nav-link.active {
            color: #fff !important;
            background-color: <?php echo $themeColor; ?> !important;
            font-weight: bold;
            border-radius: 0;
        }

        .navbar {
            background-color: <?php echo $themeColor; ?> !important;
        }

        .btn-primary {
            background-color: <?php echo $themeColor; ?> !important;
            border-color: <?php echo $themeColor; ?> !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top justify-content-center">
        <span class="navbar-text text-white font-weight-bold" id="current-date-time"></span>
    </nav>