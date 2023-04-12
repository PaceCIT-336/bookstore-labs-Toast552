<?php
session_start();

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
session_destroy();

// Prevent session fixation attacks
session_regenerate_id(true);

// Unset all session-related PHP variables
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    unset($_COOKIE[session_name()]);
}

// Remove session ID from URL
if (ini_get("session.use_trans_sid")) {
    $currentURL = $_SERVER['REQUEST_URI'];
    $newURL = str_replace(['?'.session_name().'=', '&'.session_name().'='], '', $currentURL);
    if ($newURL !== $currentURL) {
        header('Location: '.$newURL);
        exit();
    }
}

// Redirect to login page
header("Location: index.php");
exit();
?>
