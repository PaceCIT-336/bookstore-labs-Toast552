<?php
// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if session exists
if (session_status() === PHP_SESSION_ACTIVE) {
    // Clear all session variables
    $_SESSION = array();

    // Delete session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
}

// Print session variables
var_dump($_SESSION);

// Print cookies
var_dump($_COOKIE);

// Redirect to login page
header("Location: index.php");
exit();
?>
