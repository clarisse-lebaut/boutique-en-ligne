<?php
// Destroy all session variable
$_SESSION = array();

// Deleted all session's cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Destroy the session
session_destroy();

// Redirect to homepage or another page after logout
header("Location: ../pages/home.php");
exit();
