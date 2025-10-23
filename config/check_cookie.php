<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/config/connect.php'; // local
// require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/assets/jwt/vendor/autoload.php'; // local

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/jwt/vendor/autoload.php'; // hosting

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
$jwt = $_COOKIE['duit_token'] ?? null;

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
