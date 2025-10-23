<?php

// Auto-detect if running on localhost or domain
$is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
    strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

if ($is_localhost) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/connect.php'; // local
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
}

$user = require_once base_path('config/check_cookie.php');
echo "<script>window.location='" . base_url('dashboard') . "';</script>";
