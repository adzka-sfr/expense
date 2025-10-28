<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

// Auto-detect if running on localhost or domain
$is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
    strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

if ($is_localhost) {
    // Database connection parameters
    $host = 'localhost';  // local
    $dbname = 'expense'; // local
    $username = 'root';  // local
    $password = '';  // local
} else {
    // Database connection parameters
    $host = 'localhost';  // hosting
    $dbname = 'u266480338_expense'; // hosting
    $username = 'u266480338_octamonica';  // hosting
    $password = 'Alfianwai1';  // hosting
}

try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// base url
function base_url($path = '')
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

    // Auto-detect if running on localhost or domain
    $is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

    if ($is_localhost) {
        $domain = $_SERVER['HTTP_HOST'] . '/expense'; // local
    } else {
        $domain = $_SERVER['HTTP_HOST']; // hosting
    }

    // $domain = $_SERVER['HTTP_HOST'] . '/expense'; // local

    return $protocol . "://" . $domain . "/" . ltrim($path, '/');
}

// For including PHP files, use the server's document root
function base_path($path = null)
{
    // Auto-detect if running on localhost or domain
    $is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

    if ($is_localhost) {
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/expense/'; // local
    } else {
        $base_path = $_SERVER['DOCUMENT_ROOT']; // hosting
    }

    if ($path != null) {
        return $base_path . '/' . trim($path, '/');
    } else {
        return $base_path;
    }
}
// tes git lewat git dekstop

$key = 'adzkagacor';

$hari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];

$bulan = [
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
];
