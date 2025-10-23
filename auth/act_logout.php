<?php
$cookie_name = "expense_token";
$cookie_path = "/expense/"; // Must match the path used when setting the cookie

$is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
    strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

if ($is_localhost) {
    $cookie_domain = ""; // local
} else {
    $cookie_domain = "expense.adzkasfr.com"; // hosting
}

// Unset the cookie from the PHP superglobal array
unset($_COOKIE[$cookie_name]);

// Attempt to clear the cookie with various paths and domains
setcookie($cookie_name, "", time() - 3600, $cookie_path, $cookie_domain, false, true);
setcookie($cookie_name, "", time() - 3600, "/expense/", $cookie_domain, false, true);
setcookie($cookie_name, "", time() - 3600, "/", $cookie_domain, false, true);

// Try with and without domain
setcookie($cookie_name, "", time() - 3600, $cookie_path, "", false, true);
setcookie($cookie_name, "", time() - 3600, "/", "", false, true);

// Redirect to login page
if ($is_localhost) {
    header("Location: /expense/auth/main.php?page=login"); // local
} else {
    header("Location: /auth/main.php?page=login"); // hosting
}
exit();
