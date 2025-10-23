<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

// Database connection parameters
// $host = 'localhost';  // local
// $dbname = 'duit'; // local
// $username = 'root';  // local
// $password = '';  // local

$host = 'localhost';  // hosting
$dbname = 'u266480338_duit'; // hosting
$username = 'u266480338_bismillahadzka';  // hosting
$password = 'Alfianwai1';  // hosting

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
    // $domain = $_SERVER['HTTP_HOST'] . '/duit'; // local
    $domain = $_SERVER['HTTP_HOST']; // hosting
    return $protocol . "://" . $domain . "/" . ltrim($path, '/');
}

// For including PHP files, use the server's document root
function base_path($path = null)
{
    // $base_path = $_SERVER['DOCUMENT_ROOT'] . '/duit/'; // local
    $base_path = $_SERVER['DOCUMENT_ROOT']; // hosting
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
