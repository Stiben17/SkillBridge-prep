<?php
session_start(); // Start the session

// Destroy all session variables
$_SESSION = array();

// Destroy the session itself
session_destroy();

// Optionally remove session cookie from browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page or home page
header("Location: Login.php");
exit();
?>