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

// get data post
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute the SQL statement to check if the username exists
$stmt = $connect->prepare("SELECT * FROM t_auth WHERE c_username = :c_username LIMIT 1");
$stmt->bindParam(':c_username', $username);
$stmt->execute();

// Fetch the user data
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Verify the password
    if (password_verify($password, $user['c_password'])) {
        if ($is_localhost) {
            $iss = "http://localhost/expense"; // local
        } else {
            $iss = "https://expense.adzkasfr.com/"; // hosting
        }
        // Create the payload for the JWT
        $payload = [
            'iss' => $iss,
            'iat' => time(),
            'exp' => time() + (30 * 24 * 60 * 60), // 30 days expiration
            'data' => [
                'id' => $user['id'],
                'username' => $user['c_username'],
                'email' => $user['c_email'],
                'theme' => $user['c_theme']
            ]
        ];

        // Encode the payload into a JWT
        $jwt = JWT::encode($payload, $key, 'HS256');

        // Set the JWT in a cookie
        if ($is_localhost) {
            setcookie("expense_token", $jwt, time() + (30 * 24 * 60 * 60), "/", "localhost", false, true); // local
        } else {
            setcookie("expense_token", $jwt, time() + (30 * 24 * 60 * 60), "/", "expense.adzkasfr.com", false, true); // hosting
        }

        // Redirect to the protected page
        echo "success";
        exit();
    } else {
        echo "password-error";
    }
} else {
    echo "username-not-exist";
}
