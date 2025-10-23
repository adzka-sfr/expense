<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/config/connect.php'; // local
// require_once $_SERVER['DOCUMENT_ROOT'] . '/duit/assets/jwt/vendor/autoload.php'; // local

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/jwt/vendor/autoload.php'; // hosting

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
        // Create the payload for the JWT
        $payload = [
            // 'iss' => "http://localhost/duit", // local
            'iss' => "https://duit.adzkasfr.com/", // hosting
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
        // setcookie("duit_token", $jwt, time() + (30 * 24 * 60 * 60), "/", "localhost", false, true); // local
        setcookie("duit_token", $jwt, time() + (30 * 24 * 60 * 60), "/", "duit.adzkasfr.com", false, true); // hosting

        // Redirect to the protected page
        echo "success";
        exit();
    } else {
        echo "password-error";
    }
} else {
    echo "username-not-exist";
}
