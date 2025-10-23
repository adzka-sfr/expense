<?php

// Auto-detect if running on localhost or domain
$is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
    strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

if ($is_localhost) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/connect.php'; // local
    require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/assets/jwt/vendor/autoload.php'; // local
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/jwt/vendor/autoload.php'; // hosting
}

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function getUserFromJwt($jwt, $key)
{
    try {
        // Check if the JWT is a non-null string
        if ($jwt === null || !is_string($jwt)) {
            return null;
        }
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        return (array) $decoded->data;
    } catch (Exception $e) {
        // Return null if decoding fails
        return null;
    }
}

// Check if the JWT token exists in the cookie
$jwt = $_COOKIE['expense_token'] ?? null;

if ($jwt === null) {
    if (strpos($_SERVER['REQUEST_URI'], '/auth') === false) {
        echo "<script>console.log('Token not found, redirecting to auth'); window.location='" . base_url('auth') . "';</script>";
        exit();
    }
}

$user = getUserFromJwt($jwt, $key);

// Redirect to auth if JWT validation fails and we're not in the auth directory
if (!$user && strpos($_SERVER['REQUEST_URI'], '/auth') === false) {
    echo "<script>console.log('Invalid token, redirecting to auth'); window.location='" . base_url('auth') . "';</script>";
    exit();
}

return $user;
